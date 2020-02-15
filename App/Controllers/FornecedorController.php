<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/2019
 * Time: 13:27
 */

namespace App\Controllers;

use App\Models\Fornecedor;
use App\Models\Login;
use project\pages\PageCadastro;
use project\validacao\Validacao;

class FornecedorController extends Controller {


    // Tela Dados da Fornecedores
    public function fornecedores($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;

        $paginas = array();

        if($busca != ''){
            $paginacao = Fornecedor::getPageBusca($busca);
        } else {
            $paginacao = Fornecedor::getPage($pagina);
        }

        if(!$paginacao['data']){
            Fornecedor::setError("Nenhum registro encontrado!");
        } else {

            for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                array_push($paginas, array(
                    'href' => '/admin/fornecedores?' . http_build_query(array(
                            'pagina' => $cont + 1,
                            'busca' => $busca
                        )),
                    'text' => $cont + 1
                ));
            }
        }

        $page = new PageCadastro();

        $page->setTpl("fornecedores", array(
            "fornecedorSucesso"=>Fornecedor::getSuccess(),
            "fornecedorErro"=>Fornecedor::getError(),
            "fornecedores"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    public function buscaFornecedor($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $paginacao = null;
        $paginas = array();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;

        if($busca){
            $paginacao = Fornecedor::getBuscaFornecedor($busca,$pagina);

            for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                array_push($paginas, array(
                    'href' => '/admin/fornecedores/buscar?' . http_build_query(array(
                            'pagina' => $cont + 1,
                            'busca' => $busca
                        )),
                    'text' => $cont + 1
                ));
            }

            if(!$paginacao['data']){
                Fornecedor::setError("Cadastra novo Fornecedor");
            }
        }

        $page = new PageCadastro();

        $page->setTpl("buscar_fornecedor", array(
            "fornecedorSucesso"=>Fornecedor::getSuccess(),
            "fornecedorErro"=>Fornecedor::getError(),
            "fornecedorErroAtiva"=>Fornecedor::getError(),
            "fornecedores"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    //Cadastrar Fornecedor
    public function cadastrarFornecedor($request, $response){
        Login::verifyLogin();

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("cadastro_fornecedor", array(
                "fornecedorErro" => Fornecedor::getError(),
                "fornecedorSucesso" => Fornecedor::getSuccess()

            ));
        } else {
            $fornecedor = new Fornecedor();

            $posts = $request->getParsedBody();

            if(Fornecedor::ckecarCnpjExiste($posts['cnpj'])=== true){
                Fornecedor::setError("CNPJ já; cadastrado!");

                header("Location: /admin/fornecedores/cadastra");
                exit;

            } else if (!Validacao::validaCNPJ($posts["cnpj"])) {
                Fornecedor::setError("CNPJ não; existe!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-fornecedor'));
            }

            try{
                $fornecedor->setData($posts);

                $fornecedor->salvarFornecedor();

                Fornecedor::setSuccess("Fornecedor Cadastrado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('fornecedores'));

            } catch (\Exception $e) {
                Fornecedor::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('cadastra-fornecedor'));
            }
        }
    }


    public function atualizarFornecedor($request, $response, $params){
        Login::verifyLogin();

        $fornecedor = new Fornecedor();

        $fornecedor->get((int)$params['id_fornecedor']);

        if ($request->isGet()) {
            $page = new PageCadastro();

            $page->setTpl("atualizar_fornecedor", array(
                "fornecedor" =>$fornecedor->getValues(),
                "fornecedorErro" => Fornecedor::getError(),
                "fornecedorSucesso" => Fornecedor::getSuccess()
            ));
        } else {
            $posts = $request->getParsedBody();

            if (!Validacao::validaCNPJ($posts["cnpj"])) {
                Fornecedor::setError("CNPJ não; existe!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-fornecedor',['id_fornecedor'=>$fornecedor->getid_fornecedor()]));
            }

            try {
                $fornecedor->setData($posts);

                $fornecedor->salvarFornecedor();

                Fornecedor::setSuccess("Fornecedor Alterada com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('fornecedores'));

            } catch (\Exception $e) {
                Fornecedor::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('atualiza-fornecedor',['id_fornecedor'=>$fornecedor->getid_fornecedor()]));
            }
        }

    }

    //Tela detalhar cadastro de Fornecedor
    public static function detalharFornecedor($request, $response, $params){
        Login::verifyLogin();

        $fornecedor = new Fornecedor();

        $fornecedor->get((int)$params['id_fornecedor']);

        $page = new PageCadastro();

        $page->setTpl("detalhar_fornecedor", array(
            "fornecedor"=>$fornecedor->getValues()
        ));

    }

    //Excluir cadastro de Fornecedor(alterar status para inativo)
    public function excluirFornecedor($request, $response, $params){
        Login::verifyLogin();

        $fornecedor = new Fornecedor();

        $fornecedor->get((int)$params['id_fornecedor']);

        try{
            $fornecedor->setstatus_fornecedor("inativo");

            $fornecedor->alteraStatusFornecedor();

            Fornecedor::setSuccess("Fornecedor Excluido com Sucesso!");

            return $response->withRedirect($this->container->router->pathFor('fornecedores'));

        } catch (\Exception $e) {
            Fornecedor::setError("Erro ao Excluir Fornecedor!");

            return $response->withRedirect($this->container->router->pathFor('fornecedores'));
        }
    }

    //Ativa cadastro de Fornecedor(alterar status para ativo)
    public function ativaFornecedor($request, $response, $params){
        Login::verifyLogin();

        $fornecedor = new Fornecedor();

        $fornecedor->get((int)$params['id_fornecedor']);

        try{
            $fornecedor->setstatus_fornecedor("ativo");

            $fornecedor->alteraStatusFornecedor();

            Fornecedor::setSuccess("Sucesso ao Ativar Registro!");

            return $response->withRedirect($this->container->router->pathFor('fornecedores'));

        } catch (\Exception $e) {
            Fornecedor::setError("Erro ao Ativar Registro!");

            return $response->withRedirect($this->container->router->pathFor('fornecedores'));
        }
    }

}