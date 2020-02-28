<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/2019
 * Time: 20:29
 */

namespace App\Controllers;

use project\pages\PageCadastro;
use project\validacao\Validacao;
use App\Models\Login;
use App\Models\Usuario;
use App\Models\EstadosCidades;

class FuncionarioController extends Controller {

    //Tela cadastrar Funcionário
    public function cadastrarFuncionario($request, $response){
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        if ($request->isGet()) {

            $page = new PageCadastro();

            if($acesso == true) {

                $estados = EstadosCidades::listarEstado();

                $page->setTpl("cadastro_funcionario", array(
                    "estados" => $estados,
//            "cidades"=>$cidades,
                    "funcionarioErro" => Usuario::getError(),
                    "funcionarioSucesso" => Usuario::getSuccess()
                ));

            } else {
                return $response->withRedirect($this->container->router->pathFor('admin'));
            }
        } else {

            $funcionario = new Usuario();

            $posts = $request->getParsedBody();


            if (Usuario::ckecarEmailExiste($posts['email'])=== true && Usuario::ckecarCpfExiste($posts['cpf'])=== true){

                Usuario::setError("CPF e E-mail já cadastrados!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            } else if(Usuario::ckecarCpfExiste($posts['cpf'])=== true){
                Usuario::setError("CPF já cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            } else if(Usuario::ckecarEmailExiste($posts['email'])=== true){
                Usuario::setError("E-mail já cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            } else if (!Validacao::validaCPF($posts["cpf"])) {
                Usuario::setError("CPF não existe!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            }

            try{
                $funcionario->settipo_usuario(2); //Usuario funcionario
                $funcionario->setData($posts);

                $funcionario->salvarUsuario();

                Usuario::setSuccess("Funcionário Cadastrado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('funcionarios'));

            } catch (\Exception $e) {

                Usuario::setError("Erro ao Cadastrar Funcionario!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));
            }

        }
    }

    // Tela Funcionário
    public function funcionarios($request, $response){
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $paginas = array();
        $tipo_usuario = 2; //Funcionario
        if($busca != ''){
            $paginacao = Usuario::getPageBusca($busca,$tipo_usuario);
        } else {
            $paginacao = Usuario::getPage($pagina,$tipo_usuario);
        }

        if(!$paginacao['data']){
            Usuario::setError("Nenhum registro encontrado!");
        } else {

            for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                array_push($paginas, array(
                    'href' => '/admin/funcionarios?' . http_build_query(array(
                            'pagina' => $cont + 1,
                            'busca' => $busca

                        )),
                    'text' => $cont + 1
                ));
            }

        }

        $page = new PageCadastro();

        if($acesso == true) {

            $page->setTpl("funcionarios", array(
                "funcionarioSucesso" => Usuario::getSuccess(),
                "funcionarioErro" => Usuario::getError(),
                "funcionarios" => $paginacao['data'],
                "busca" => $busca,
                "paginas" => $paginas
            ));

        } else {
            return $response->withRedirect($this->container->router->pathFor('admin'));
        }
    }

    // Tela buscar Funcionário
    public function buscaFuncionario($request, $response){
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        $gets = $request->getParams();

        $paginacao = null;
        $paginas = array();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $tipo_usuario = 2; //Funcionario

        if ($busca) {

                $paginacao = Usuario::getBuscaUsuario($busca,$tipo_usuario, $pagina);

                for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                    array_push($paginas, array(
                        'href' => '/admin/funcionarios/buscar?' . http_build_query(array(
                                'pagina' => $cont + 1,
                                'busca' => $busca
                            )),
                        'text' => $cont + 1
                    ));
                }

            if (!$paginacao['data']) {
                Usuario::setError("Cadastra novo Funcionário");
                }
            }


        $page = new PageCadastro();

        if($acesso == true) {

            $page->setTpl("buscar_funcionario", array(
                "funcionarioSucesso" => Usuario::getSuccess(),
                "funcionarioErro" => Usuario::getError(),
                "funcionarioErroAtiva" => Usuario::getError(),
                "funcionarios" => $paginacao['data'],
                "busca" => $busca,
                "paginas" => $paginas
            ));

        } else {
            return $response->withRedirect($this->container->router->pathFor('admin'));
        }
    }

    //Tela atualizar Funcionário
    public function atualizarFuncionario($request, $response, $params){
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        $funcionario = new Usuario();

        $estados = EstadosCidades::listarEstado();

        $funcionario->getUsuario((int)$params['id_usuario'],2);

        if ($request->isGet()) {

            $page = new PageCadastro();

            if($acesso == true) {
                $page->setTpl("atualizar_funcionario", array(
                    "estados" => $estados,
                    "funcionarioErro" => Usuario::getError(),
                    "funcionario" => $funcionario->getValues()
                ));
            } else {
                return $response->withRedirect($this->container->router->pathFor('admin'));
            }


        } else {

            $posts = $request->getParsedBody();

            $posts["acesso"] = (isset($posts["acesso"]))?1:0;

            try{
                $funcionario->setData($posts);

                $funcionario->atualizarFuncionario();

                Usuario::setSuccess("Funcionário Alterado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('funcionarios'));

            } catch (\Exception $e) {

                Usuario::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('atualiza-funcionario',['id_usuario'=>$funcionario->getid_usuario()]));
            }
        }
    }

    //Tela detalhar cadastro de Funcionário
    public function detalharFuncionario($request, $response, $params){
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        $funcionario = new Usuario();

        $funcionario->getUsuario((int)$params['id_usuario'],2);

        $page = new PageCadastro();

        if($acesso == true) {

        $page->setTpl("detalhar_funcionario", array(
            "funcionario"=>$funcionario->getValues()
        ));

        } else {
            return $response->withRedirect($this->container->router->pathFor('admin'));
        }

    }

    //Excluir cadastro de Funcionário
    public function excluirFuncionario($request, $response, $params){
        Login::verifyLogin();

        $funcionario = new Usuario();

        $funcionario->getUsuario((int)$params['id_usuario'],2);

        try{
            $funcionario->setstatus_usuario("inativo");

            $funcionario->alteraStatusUsuario();

            Usuario::setSuccess("Funcionário Excluido com Sucesso!");

            return $response->withRedirect($this->container->router->pathFor('funcionarios'));

        } catch (\Exception $e) {

            Usuario::setError("Erro ao Excluir Funcionário!");

            return $response->withRedirect($this->container->router->pathFor('funcionarios'));
        }
    }

    //Ativa cadastro de Funcionário inativado
    public function ativaFuncionario($request, $response, $params){

        Login::verifyLogin();

        $funcionario = new Usuario();

        $funcionario->getUsuario((int)$params['id_usuario'],2);

        try{
            $funcionario->setstatus_usuario("ativo");

            $funcionario->alteraStatusUsuario();

            Usuario::setSuccess("Sucesso ao Ativar Registro!");

            return $response->withRedirect($this->container->router->pathFor('funcionarios'));

        } catch (\Exception $e) {

            Usuario::setError("Erro ao Ativar Registro!");

            return $response->withRedirect($this->container->router->pathFor('buscar-funcionario'));
        }

    }

}
