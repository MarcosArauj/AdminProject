<?php


namespace App\Controllers;

use App\Models\Empresa;
use App\Models\Usuario;
use project\pages\PageRecuperaSenha;
use App\Models\RecuperaSenha;


class RecuperaSenhaController extends Controller {

    public function esqueciSenha($request, $response){

        if($request->isGet()) {

        $page = new PageRecuperaSenha();

        $page->setTpl("esqueci-senha",array(
            'erro'=>RecuperaSenha::getError()
        ));

        } else {
            try{

                $posts = $request->getParsedBody();

                $recuperarSenha = RecuperaSenha::getEmailRecuperaSenha($posts["email"]);

                return $response->withRedirect($this->container->router->pathFor('email-enviado'));

            } catch (\Exception $e){
                RecuperaSenha::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('esqueci-senha'));
            }
        }
    }

    public static function emailEnviado($request, $response){
        $page = new PageRecuperaSenha();

        $page->setTpl("email-enviado",array(
            'erro'=>RecuperaSenha::getError()
        ));
    }

    public static function recuperaSenha($request, $response){

        $recuperarSenha = null;

        if($request->isGet()) {

            try {
                $recuperarSenha = RecuperaSenha::validRecuperaDecrypt($request->getParam("code"));

            } catch (\Exception $e) {
                RecuperaSenha::setError($e->getMessage());
            }

            $page = new PageRecuperaSenha();



            $page->setTpl("esqueci-recuperar", array(
                'name' => $recuperarSenha["primeiro_nome"],
                'code' => $request->getParam('code'),
                'erro' => RecuperaSenha::getError(),


            ));

        } else {
            $recuperarSenha = null;

            $posts = $request->getParsedBody();

            try{
                $recuperarSenha = RecuperaSenha::validRecuperaDecrypt($posts["code"]);

                RecuperaSenha::setRecuperaUsada($recuperarSenha['id_recupera']);

            } catch (\Exception $e){
                RecuperaSenha::setError($e->getMessage());
            }

            $usuario = new Usuario();

            $usuario->get((int)$recuperarSenha['id_usuario']);

            $usuario->setsenha($posts['nova_senha']);

            $usuario->atualizarSenha();

            $page = new PageRecuperaSenha();

            $page->setTpl("recupera-senha-sucesso", array(
                'erro'=>RecuperaSenha::getError()
            ));
        }


    }

}