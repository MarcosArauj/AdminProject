<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/2019
 * Time: 13:27
 */

namespace App\Controllers;

use project\pages\PageCadastro;
use App\Models\Login;
use App\Models\Fabricante;

class FabricanteController extends Controller {

    ///Carrega tela de fabricantes
    public function fabricantes($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $paginas = array();

        if($busca != ''){
            $paginacao = Fabricante::getPageBusca($busca);
        } else {
            $paginacao = Fabricante::getPage($pagina);
        }

        if(!$paginacao['data']){
            Fabricante::setError("Nenhum registro encontrado!");
        } else {
            for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                array_push($paginas, array(
                    'href' => '/admin/fabricantes?' . http_build_query(array(
                            'pagina' => $cont + 1,
                            'busca' => $busca
                        )),
                    'text' => $cont + 1
                ));
            }
        }

        $page = new PageCadastro();

        $page->setTpl("fabricantes", array(
            "fabricanteSucesso"=>Fabricante::getSuccess(),
            "fabricanteErro"=>Fabricante::getError(),
            "fabricantes"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    // Carregar cadastro de Fabricante
    public function cadastrarFabricante($request, $response){
        Login::verifyLogin();

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("cadastro_fabricante", array(
                "fabricanteSucesso" => Fabricante::getSuccess(),
                "fabricanteErro" => Fabricante::getError()
            ));
        } else {
            $fabricante = new Fabricante();

            $posts = $request->getParsedBody();

            if(Fabricante::ckecarFabricanteExiste($posts['nome_fabricante'])=== true) {
                Fabricante::setError("Fabricante j&aacute; cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-fabricante'));
            }

            try{
                $fabricante->setData($posts);

                $fabricante->salvarFabricante();

                Fabricante::setSuccess("Fabricante Cadastrado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('fabricantes'));;

            } catch (\Exception $e) {
                Fabricante::setError("Erro ao Cadastrar Fabricante Produto!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-fabricante'));
            }
        }
    }

    // Carregar atualizar Fabricantes
    public function aualizarFabricante($request, $response, $params){

        Login::verifyLogin();

        $fabricante = new Fabricante();

        $fabricante->get((int)$params['id_fabricante']);

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("atualizar_fabricante", array(
                "fabricante" => $fabricante->getValues(),
                "fabricanteErro" => Fabricante::getError()
            ));

        } else {
            $posts = $request->getParsedBody();

            if($posts['nome_fabricante'] !== $fabricante->getnome_fabricante()){
                if(Fabricante::ckecarFabricanteExiste($_POST['nome_fabricante'])=== true) {
                    Fabricante::setError("Fabricante j&aacute; cadastrado!");

                    return $response->withRedirect($this->container->router->pathFor('atualiza-fabricante',['id_fabricante'=>$fabricante->getid_fabricante()]));
                }
            }
            try{
                $fabricante->setData($posts);

                $fabricante->salvarFabricante();

                Fabricante::setSuccess("Fabricante Alterado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('fabricantes'));
            } catch (\Exception $e) {
                Fabricante::setError("Erro ao Alterar Fabricante Produto!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-fabricante',['id_fabricante'=>$fabricante->getid_fabricante()]));
            }
        }

    }

    //Excluir Fabricante
    public function excluirFabricante($request, $response, $params){
        Login::verifyLogin();

        $fabricante = new Fabricante();

        $fabricante->get((int)$params['id_fabricante']);

        try{

            $fabricante->excluir();

            Fabricante::setSuccess("Fabricante Excluido com Sucesso!");

            return $response->withRedirect($this->container->router->pathFor('fabricantes'));

        } catch (\Exception $e) {
            Fabricante::setError("Erro ao Excluir Fabricante Produto!");

            return $response->withRedirect($this->container->router->pathFor('fabricantes'));
        }
    }

    // Produtos relacionados a Fabricante
    public static function fabricanteProduto($request, $response, $params){
        Login::verifyLogin();

        $fabricante = new Fabricante();

        $fabricante->get((int)$params['id_fabricante']);

        if(!$fabricante->getProdutosFabricantes()) {
            Fabricante::setError("Não existe Produtos relacionados a esse Fabricante!");
        }
        $page = new PageCadastro();

        $page->setTpl("fabricantes_produtos", array(
            'fabricante'=>$fabricante->getValues(),
            'fabricanteErro' => Fabricante::getError(),
            'fabricanteProdutos'=>$fabricante->getProdutosFabricantes()

        ));

    }
}
