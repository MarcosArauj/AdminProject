<?php


namespace App\Controllers;


use App\Models\Login;
use App\Models\Proprietario;
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

            $proprietario = new Proprietario();

            $posts = $request->getParsedBody();

            if (Proprietario::ckecarEmailExiste($posts['email']) === true && Proprietario::ckecarCpfExiste($posts['cpf']) === true) {

                Proprietario::setError("CPF e E-mail já; cadastrados!");

                return $response->withRedirect($this->container->router->pathFor('login'));

            } else if (Proprietario::ckecarCpfExiste($posts['cpf']) === true) {
                Proprietario::setError("CPF já; cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('login'));

            } else if (Proprietario::ckecarEmailExiste($posts['email']) === true) {
                Proprietario::setError("E-mail já; cadastrado!");

                header("Location: /");
                exit;
            } else if (!Validacao::validaCPF($posts["cpf"])) {
                Proprietario::setError("CPF não; existe!");

                return $response->withRedirect($this->container->router->pathFor('login'));
            }

            try {
                $proprietario->setData($posts);

                $proprietario->salvarProprietario();

                return $response->withRedirect($this->container->router->pathFor('cadastrarProprietario'));

            } catch (\Exception $e) {

                Proprietario::setErrorRegister("Erro ao Cadastrar Proprietario!");

                return $response->withRedirect($this->container->router->pathFor('login'));
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
                "perfilErro" => Proprietario::getError()
            ));
        } else {
            $proprietario = Login::getFromSession();

            $posts = $request->getParsedBody();

            if($posts['email'] !== $proprietario->getemail()){
                if(Proprietario::ckecarEmailExiste($posts['email'])=== true){
                    Proprietario::setError("E-mail já; cadastrado!");

                    return $response->withRedirect($this->container->router->pathFor('atualiza-proprietario'));
                }
            }

            try{

                $proprietario->setData($posts);

                $proprietario->atualizaProprietario();

                Proprietario::setSuccess("Dados Alterado com Sucesso! Na próxima vez que fizer o Login verá as Alterações!" );

                return $response->withRedirect($this->container->router->pathFor('perfil'));

            } catch (\Exception $e) {

                Proprietario::setError("Erro ao Alterar Dados!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-proprietario'));
            }

        }
    }

}
