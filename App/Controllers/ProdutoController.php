<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/2019
 * Time: 20:28
 */

namespace App\Controllers;

use project\pages\PageCadastro;
use App\Models\Login;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Fabricante;

class ProdutoController extends Controller {

    //Tela Produtos
    public function produtos($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $paginas = array();

        if($busca != ''){
            $paginacao = Produto::getPageBusca($busca);
        } else {
            $paginacao = Produto::getPage($pagina);
        }

        if(!$paginacao['data']){
            Produto::setError("Nenhum registro encontrado!");
        } else {
            for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                array_push($paginas, array(
                    'href' => '/admin/produtos?' . http_build_query(array(
                            'pagina' => $cont + 1,
                            'busca' => $busca
                        )),
                    'text' => $cont + 1
                ));
            }
        }

        $page = new PageCadastro();

        $page->setTpl("produtos", array(
            "produtoSucesso"=>Produto::getSuccess(),
            "produtoErro"=>Produto::getError(),
            "produtos"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    //Tela cadastrar produtos
    public function cadastrarProduto($request, $response){
        Login::verifyLogin();

        if ($request->isGet()) {

            $categorias = Categoria::listarCategoria();
            $fabricantes = Fabricante::listarFaricante();

            $page = new PageCadastro();

            $page->setTpl("cadastro_produto", array(
                "produtoErro" => Produto::getError(),
                "categorias" => $categorias,
                "fabricantes" => $fabricantes
            ));
        } else {
            $produto = new Produto();

            $posts = $request->getParsedBody();

            if(Produto::ckecarProdutoExiste($posts['nome_produto'],$posts['fabricante_id'],$posts['descricao'])=== true) {
                Produto::setError("Produto já cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-produto'));
            }

            try{
                $produto->setData($posts);

                $produto->salvarProduto();

                $produto->setFotoProduto($_FILES["foto_produto"]);

                Produto::setSuccess("Produto Cadastrado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('produtos'));

            } catch (\Exception $e) {

                Produto::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('cadastra-produto'));
            }
        }
    }

    //Detalahar produto
    public function detalharProduto($request, $response, $params){
        Login::verifyLogin();

        $produto = new Produto();

        $produto->getFromURL($params['url']);

        $page = new PageCadastro();

        $page->setTpl("detalhar_produto", array(
            "produtoFotoSucesso"=>Produto::getSuccess(),
            "produto"=>$produto->getValues()
        ));
    }

    //Tela atualizar cadastro de produto
    public function atualizarProduto($request, $response, $params){
        Login::verifyLogin();

        $produto = new Produto();
        $categorias = Categoria::listarCategoria();
        $fabricantes = Fabricante::listarFaricante();

        $produto->get((int)$params['id_pcf']);

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("atualizar_produto", array(
                "produtoErro" => Produto::getError(),
                "categorias" => $categorias,
                "fabricantes" => $fabricantes,
                "produto" => $produto->getValues()
            ));
        } else {
            $posts = $request->getParsedBody();

            if($posts['nome_produto'] !== $produto->getnome_produto() || $posts['fabricante_id'] !== $produto->getfabricante_id()
                || $posts['descricao'] !== $produto->getdescricao()){
                if(Produto::ckecarProdutoExiste($_POST['nome_produto'],$posts['fabricante_id'],$posts['descricao'])=== true) {
                    Categoria::setError("Produto j&aacute; cadastrado!");

                    return $response->withRedirect($this->container->router->pathFor('atualiza-produto',['id_pcf'=>$produto->getid_pcf()]));
                }

            }
            try{
                $produto->setData($posts);

                $produto->atualizarProduto();

                Produto::setSuccess("Produto Alterado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('produtos'));

            } catch (\Exception $e) {
                Produto::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('atualiza-produto',['id_pcf'=>$produto->getid_pcf()]));
            }
        }
    }

    //Tela atualizar Imagem do produto
    public  function atualizarFotoProduto($request, $response, $params){
        Login::verifyLogin();

        $produto = new Produto();

        $produto->get((int)$params['id_pcf']);

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("atualizar_fproduto", array(
                "produtoFotoErro" => Produto::getError(),
                "produto" => $produto->getValues()
            ));

        } else {
            $posts = $request->getParsedBody();

            try{

                $produto->setData($posts);

                $produto->setFotoProduto($_FILES["foto_produto"]);

                Produto::setSuccess("Imgagem do Produto Alterada com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('detalha-produto',['url'=>$produto->geturl()]));
            } catch (\Exception $e) {

                Produto::setError("Erro ao Alterar a imagem do Produto!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-foto-produto',['id_pcf'=>$produto->getid_pcf()]));
            }
        }
    }

    //Excluir produto
    public function excluirProduto($request, $response, $params){
        Login::verifyLogin();

        $produto = new Produto();

        $produto->get((int)$params['id_pcf']);

        try{
            $produto->excluirProduto();

            Produto::setSuccess("Produto Excluido com sucesso!");

            return $response->withRedirect($this->container->router->pathFor('produtos'));

        } catch (\Exception $e) {
            Produto::setError("Erro ao Excluir Produto!");

            return $response->withRedirect($this->container->router->pathFor('produtos'));
        }
    }

}
