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
use App\Models\Categoria;

class CategoriaController extends Controller {

    ///Carrega tela de categorias
    public function categorias($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $paginas = array();

        if($busca != ''){
            $paginacao = Categoria::getPageBusca($busca);
        } else {
            $paginacao = Categoria::getPage($pagina);
        }

        if(!$paginacao['data']){
            Categoria::setError("Nenhum registro encontrado!");
        } else {
            for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                array_push($paginas, array(
                    'href' => '/admin/categorias?' . http_build_query(array(
                            'pagina' => $cont + 1,
                            'busca' => $busca
                        )),
                    'text' => $cont + 1
                ));
            }
        }

        $page = new PageCadastro();

        $page->setTpl("categorias", array(
            "categoriaSucesso"=>Categoria::getSuccess(),
            "categoriaErro"=>Categoria::getError(),
            "categorias"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    // Carregar tela de cadastro de categorias
    public function cadastrarCategoria($request, $response){
        Login::verifyLogin();

        if ($request->isGet()) {
            $page = new PageCadastro();

            $page->setTpl("cadastro_categoria", array(
                "categoriaSucesso" => Categoria::getSuccess(),
                "categoriaErro" => Categoria::getError()
            ));
        } else {
            $categoria = new Categoria();

            $posts = $request->getParsedBody();

            if(Categoria::ckecarCategoriaExiste($posts['nome_categoria'])=== true) {
                Categoria::setError("Categoria j&aacute; cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-categoria'));
            }
            try{
                $categoria->setData($posts);

                $categoria->salvarCategoria();

                Categoria::setSuccess("Categoria Cadastrada com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('categorias'));

            } catch (\Exception $e) {
                Categoria::setError("Erro ao Cadastrar Categoria Produto!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-categoria'));
            }
        }
    }


    // Carregar atualizar categorias
    public function aualizarCategoria($request, $response, $params){
        Login::verifyLogin();

        $categoria = new Categoria();

        $categoria->get((int)$params['id_categoria']);

        if ($request->isGet()) {
            $page = new PageCadastro();

            $page->setTpl("atualizar_categoria", array(
                "categoria" => $categoria->getValues(),
                "categoriaErro" => Categoria::getError()
            ));
        } else {
            $posts = $request->getParsedBody();

            if($posts['nome_categoria'] !== $categoria->getnome_categoria()){
                if(Categoria::ckecarCategoriaExiste($posts['nome_categoria'])=== true) {
                    Categoria::setError("Categoria já cadastrada!");

                    return $response->withRedirect($this->container->router->pathFor('atualiza-categoria',['id_categoria'=>$categoria->getid_categoria()]));
                }

            }
            try{
                $categoria->setData($posts);

                $categoria->salvarCategoria();

                Categoria::setSuccess("Categoria Alterada com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('categorias'));

            } catch (\Exception $e) {
                Categoria::setError("Erro ao Alterar Categoria Produto!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-categoria',['id_categoria'=>$categoria->getid_categoria()]));
            }
        }

    }

    //Excluir Categoria
    public function excluirCategoria($request, $response, $params){
        Login::verifyLogin();

        $categoria = new Categoria();

        $categoria->get((int)$params['id_categoria']);

        try{
            $categoria->excluir();

            Categoria::setSuccess("Categoria Excluida com Sucesso!");

            return $response->withRedirect($this->container->router->pathFor('categorias'));

        } catch (\Exception $e) {
            Categoria::setError("Erro ao Excluir Categoria Produto!");

            return $response->withRedirect($this->container->router->pathFor('categorias'));
        }
    }

    // Produtos relacionados a categorias
    public static function categoriaProduto($request, $response, $params){
        Login::verifyLogin();

        $categoria = new Categoria();

        $categoria->get((int)$params['id_categoria']);

        if(!$categoria->getProdutosCategorias()) {
            Categoria::setError("Não existe Produtos relacionados nessa Categoria!");
        }

        $page = new PageCadastro();

        $page->setTpl("categorias_produtos", array(
            'categoria'=>$categoria->getValues(),
            "categoriaErro" => Categoria::getError(),
            'categoriaProdutos'=>$categoria->getProdutosCategorias()

        ));


    }

}
