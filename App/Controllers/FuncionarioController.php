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
use App\Models\Cargo;
use App\Models\Login;
use App\Models\Funcionario;
use App\Models\EstadosCidades;

class FuncionarioController extends Controller {

    //Tela cadastrar Funcionário
    public function cadastrarFuncionario($request, $response){
        Login::verifyLogin();

        if ($request->isGet()) {

            $page = new PageCadastro();

            $estados = EstadosCidades::listarEstado();
            $cargo = Cargo::listarCargo();

            $page->setTpl("cadastro_funcionario", array(
                "cargos" => $cargo,
                "estados" => $estados,
//            "cidades"=>$cidades,
                "funcionarioErro" => Funcionario::getError(),
                "funcionarioSucesso" => Funcionario::getSuccess()
            ));
        } else {

            $funcionario = new Funcionario();

            $posts = $request->getParsedBody();

            $posts["acesso"] = (isset($posts["acesso"]))?1:0;


            if (Funcionario::ckecarEmailExiste($posts['email'])=== true && Funcionario::ckecarCpfExiste($posts['cpf'])=== true){

                Funcionario::setError("CPF e E-mail já cadastrados!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            } else if(Funcionario::ckecarCpfExiste($posts['cpf'])=== true){
                Funcionario::setError("CPF já cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            } else if(Funcionario::ckecarPisExiste($posts['pis'])=== true){
                Funcionario::setError("PIS já cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            } else if(Funcionario::ckecarEmailExiste($posts['email'])=== true){
                Funcionario::setError("E-mail já cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            } else if (!Validacao::validaCPF($posts["cpf"])) {
                Funcionario::setError("CPF não existe!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));

            } else if (Validacao::validaPIS($posts["pis"])) {
                Funcionario::setError("PIS não existe!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));
            }

            try{
                $funcionario->setData($posts);

                $funcionario->salvarFuncionario();

                Funcionario::setSuccess("Funcionário Cadastrado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('funcionarios'));

            } catch (\Exception $e) {

                Funcionario::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('cadastra-funcionario'));
            }

        }
    }

    // Tela Funcionário
    public function funcionarios($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $paginas = array();

        if($busca != ''){
            $paginacao = Funcionario::getPageBusca($busca);
        } else {
            $paginacao = Funcionario::getPage($pagina);
        }

        if(!$paginacao['data']){
            Funcionario::setError("Nenhum registro encontrado!");
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

        $page->setTpl("funcionarios", array(
            "funcionarioSucesso"=>Funcionario::getSuccess(),
            "funcionarioErro"=>Funcionario::getError(),
            "funcionarios"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    // Tela buscar Funcionário
    public function buscaFuncionario($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $paginacao = null;
        $paginas = array();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;

        if ($busca) {

                $paginacao = Funcionario::getBuscaFuncionario($busca, $pagina);

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
                    Funcionario::setError("Cadastra novo Funcionário");
                }
            }


        $page = new PageCadastro();

        $page->setTpl("buscar_funcionario", array(
            "funcionarioSucesso"=>Funcionario::getSuccess(),
            "funcionarioErro"=>Funcionario::getError(),
            "funcionarioErroAtiva"=>Funcionario::getError(),
            "funcionarios"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    //Tela atualizar Funcionário
    public function atualizarFuncionario($request, $response, $params){
        Login::verifyLogin();

        $funcionario = new Funcionario();

        $cargo = Cargo::listarCargo();

        $estados = EstadosCidades::listarEstado();

        $funcionario->get((int)$params['id_funcionario']);

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("atualizar_funcionario", array(
                "estados" => $estados,
                "cargo" => $cargo,
                "funcionarioErro" => Funcionario::getError(),
                "funcionario" => $funcionario->getValues()
            ));
        } else {

            $posts = $request->getParsedBody();

            $posts["acesso"] = (isset($posts["acesso"]))?1:0;

            try{
                $funcionario->setData($posts);

                $funcionario->atualizarFuncionario();

                Funcionario::setSuccess("Funcionário Alterado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('funcionarios'));

            } catch (\Exception $e) {

                Funcionario::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('atualiza-funcionario',['id_funcionario'=>$funcionario->getid_funcionario()]));
            }
        }
    }

    //Tela detalhar cadastro de Funcionário
    public static function detalharFuncionario($request, $response, $params){
        Login::verifyLogin();

        $funcionario = new Funcionario();

        $funcionario->get((int)$params['id_funcionario']);

        $page = new PageCadastro();

        $page->setTpl("detalhar_funcionario", array(
            "funcionario"=>$funcionario->getValues()
        ));

    }

    //Excluir cadastro de Funcionário
    public function excluirFuncionario($request, $response, $params){
        Login::verifyLogin();

        $funcionario = new Funcionario();

        $funcionario->get((int)$params['id_funcionario']);

        try{
            $funcionario->setstatus_funcionario("inativo");
            $funcionario->setstatus_usuario("inativo");

            $funcionario->alteraStatusFuncionario();

            Funcionario::setSuccess("Funcionário Excluido com Sucesso!");

            return $response->withRedirect($this->container->router->pathFor('funcionarios'));

        } catch (\Exception $e) {

            Funcionario::setError("Erro ao Excluir Funcionário!");

            return $response->withRedirect($this->container->router->pathFor('funcionarios'));
        }
    }

    //Ativa cadastro de Funcionário inativado
    public function ativaFuncionario($request, $response, $params){

        Login::verifyLogin();

        $funcionario = new Funcionario();

        $funcionario->get((int)$params['id_funcionario']);

        try{
            $funcionario->setstatus_usuario("ativo");
            $funcionario->setstatus_funcionario("ativo");

            $funcionario->alteraStatusFuncionario();

            Funcionario::setSuccess("Sucesso ao Ativar Registro!");

            return $response->withRedirect($this->container->router->pathFor('funcionarios'));

        } catch (\Exception $e) {

            Funcionario::setError("Erro ao Ativar Registro!");

            return $response->withRedirect($this->container->router->pathFor('buscar-funcionario'));
        }

    }

}
