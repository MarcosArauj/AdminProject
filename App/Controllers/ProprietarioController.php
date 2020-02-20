<?php


namespace App\Controllers;


use App\Models\Login;
use App\Models\Usuario;
use project\pages\PageCadastro;
use project\pages\PagePerfil;
use project\validacao\Validacao;

class ProprietarioController extends Controller {

    //Cadastrar Proprietario
    public function cadastrarProprietario($request, $response){

        if($request->isGet()){
            $pageCadastro = new PageCadastro([
                'header'=>false,
                'footer'=>false
            ]);

            $pageCadastro->setTpl('proprietario_cadastrado');

        } else {

            $proprietario = new Usuario();

            $posts = $request->getParsedBody();

            if (Usuario::ckecarEmailExiste($posts['email']) === true && Usuario::ckecarCpfExiste($posts['cpf']) === true) {

                Usuario::setError("CPF e E-mail já; cadastrados!");

                return $response->withRedirect($this->container->router->pathFor('home'));

            } else if (Usuario::ckecarCpfExiste($posts['cpf']) === true) {
                Usuario::setError("CPF já; cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('home'));

            } else if (Usuario::ckecarEmailExiste($posts['email']) === true) {
                Usuario::setError("E-mail já; cadastrado!");

                header("Location: /");
                exit;
            } else if (!Validacao::validaCPF($posts["cpf"])) {
                Usuario::setError("CPF não; existe!");

                return $response->withRedirect($this->container->router->pathFor('home'));
            }

            try {
                $proprietario->settipo_usuario('proprietario');
                $proprietario->setacesso(1);

                $proprietario->setData($posts);

                $proprietario->salvarUsuario();

                return $response->withRedirect($this->container->router->pathFor('cadastrarProprietario'));

            } catch (\Exception $e) {

                Usuario::setErrorRegister("Erro ao Cadastrar Proprietario!");

                return $response->withRedirect($this->container->router->pathFor('home'));
            }

        }
    }

    //Tela perfil Proprietario
    public function atualizaProprietario($request, $response){
        Login::verifyLogin();

        if($request->isGet()) {

            $page = new PagePerfil();

            $proprietario = Login::getFromSession();

            $page->setTpl("atualiza_proprietario", array(
                "proprietario" => $proprietario->getValues(),
                "perfilErro" => Usuario::getError()
            ));
        } else {
            $proprietario = Login::getFromSession();

            $posts = $request->getParsedBody();

            if($posts['email'] !== $proprietario->getemail()){
                if(Usuario::ckecarEmailExiste($posts['email'])=== true){
                    Usuario::setError("E-mail já; cadastrado!");

                    return $response->withRedirect($this->container->router->pathFor('atualiza-proprietario'));
                }
            }

            try{

                $proprietario->setData($posts);

                $proprietario->atualizaUsuario();

                Usuario::setSuccess("Dados Alterado com Sucesso! Na próxima vez que fizer o Login verá as Alterações!" );

                return $response->withRedirect($this->container->router->pathFor('perfil'));

            } catch (\Exception $e) {

                Usuario::setError("Erro ao Alterar Dados!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-proprietario'));
            }

        }
    }

}
