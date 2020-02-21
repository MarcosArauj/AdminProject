<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/2019
 * Time: 19:54
 */

namespace App\Controllers;


use App\Models\EstadosCidades;
use project\pages\PagePerfil;
use App\Models\Login;
use App\Models\Usuario;

class UsuarioController extends Controller {

    //Tela perfil
    public function perfil(){
        Login::verifyLogin();

        $page = new PagePerfil();

        $usuario = Login::getFromSession();

        $page->setTpl("index", array(
            "usuario"=>$usuario->getValues(),
            "perfilMsg"=>Usuario::getSuccess()
        ));
    }

    // Atualizar perfil
    public function atualizaPerfil($request, $response){
        Login::verifyLogin();

        if($request->isGet()) {

        $page = new PagePerfil();

        $estados = EstadosCidades::listarEstado();

        $usuario = Login::getFromSession();

        $page->setTpl("atualizar_usuario", array(
            "estados"=>$estados,
            "usuario"=>$usuario->getValues(),
            "perfilErro"=>Usuario::getError()
        ));

        } else {
            $usuario =  Login::getFromSession();

            $posts = $request->getParsedBody();

            if($posts['email'] !== $usuario->getemail()){
                if(Usuario::ckecarEmailExiste($posts['email'])=== true){
                    Usuario::setError("E-mail já; cadastrado!");

                    return $response->withRedirect($this->container->router->pathFor('atualiza-perfil'));
                }
            }

            try{

                $usuario->setData($posts);

                $usuario->atualizaUsuario();

                Usuario::setSuccess("Dados Alterado com Sucesso! Na próxima vez que fizer o Login verá as Alterações!" );

                return $response->withRedirect($this->container->router->pathFor('perfil'));

            } catch (\Exception $e) {

                Usuario::setError("Erro ao Alterar Dados!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-perfil'));
            }
        }
    }


    //Tela alterar Senha
    public function alteraSenha($request, $response){
        Login::verifyLogin();

        if($request->isGet()) {

            $page = new PagePerfil();

            $usuario = Login::getFromSession();

            $page->setTpl("alterar_senha", array(
                "usuario" => $usuario->getValues(),
                "sucessoAlterarSenha" => Usuario::getSuccess(),
                "erroAlterarSenha" => Usuario::getError()
            ));
        } else {

            $usuario = Login::getFromSession();

            $posts = $request->getParsedBody();

            if (!isset($posts['senha_atual']) || $posts['senha_atual'] === ''){
                Usuario::setError("Digite sua senha atual!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-senha'));

            } else if (!isset($posts['nova_senha']) || $posts['nova_senha'] === ''){
                Usuario::setError("Digite sua Nova Senha!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-senha'));

            } else if (!isset($posts['confirma_senha']) || $posts['confirma_senha'] === ''){
                Usuario::setError("Confirme sua Nova Senha!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-senha'));

            } else if ($posts['senha_atual'] === $posts['nova_senha']) {
                Usuario::setError("Digite uma senha diferente da Atual!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-senha'));
                ;
            } else if ($posts['nova_senha'] !== $posts['confirma_senha']) {
                Usuario::setError("Confirmar senha diferente da Nova senha Digitada!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-senha'));
            }

            if (!password_verify($posts['senha_atual'], $usuario->getsenha())){
                Usuario::setError("Senha Atual Inválida, Gentileza verificar!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-senha'));
            }

            try{

                $usuario->setsenha($posts['nova_senha']);

                $usuario->atualizarSenha();

                Usuario::setSuccess("Senha Alterado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-senha'));

            } catch (\Exception $e) {

                Usuario::setError("Erro ao Alterar Senha!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-senha'));
            }

        }
    }

}
