<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 20/03/2019
 * Time: 20:49
 */

namespace App\Controllers;


use App\Models\Empresa;
use App\Models\EstadosCidades;
use project\pages\PageCadastro;
use App\Models\Login;
use App\Models\Usuario;
use project\pages\PageLogin;

class LoginController extends Controller {

//---------------Login-------------------------------//
// Logar

    public function login($request, $response){

        if($request->isGet()){

            $proprietario = Usuario::listUsuario();

            if ($proprietario > 0) {


                $page = new PageLogin();

                $page->setTpl('index', array(
                    'erro'=>Usuario::getError()
                ));

            } else {

                $estados = EstadosCidades::listarEstado();

                $pageCadastro = new PageCadastro([
                    'header'=>false,
                    'footer'=>false
                ]);

                $pageCadastro->setTpl('cadastro_proprietario', array(
                    'estados'=>$estados,
                    "proprietarioErro"=>Usuario::getError()
                ));
            }

        } else {
            $posts = $request->getParsedBody();

            try{
                Login::loginAdmin($posts["login"], $posts["senha"]);

            } catch (\Exception $e){
                Usuario::setError($e->getMessage());
            }

            return $response->withRedirect($this->container->router->pathFor('admin'));
        }

    }

// Tela Adminstrativa
    public function admin($request, $response){
         Login::verifyLogin();

        $usuario = Login::getFromSession();

        $page = new PageCadastro();

        $page->setTpl("index", array(
            "usuario"=>$usuario->getValues(),
            "empresaSucesso" => Empresa::getSuccess()
        ));

    }

    // Deslogar
    public function logout($request, $response){

        Login::logout();

        return $response->withRedirect($this->container->router->pathFor('home'));

    }

}
