<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/2019
 * Time: 20:28
 */

namespace App\Controllers;

use App\Models\Promocao;
use project\pages\PageCadastro;
use App\Models\Login;

class PromocaoController extends Controller {

    //Tela Promções
    public function promocoes($request, $response){
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $paginas = array();

        if($busca != ''){
            $paginacao = Promocao::getPageBusca($busca);
        } else {
            $paginacao = Promocao::getPage($pagina);
        }

        if(!$paginacao['data']){
            Promocao::setError("Nenhum registro encontrado!");
        } else {
            for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                array_push($paginas, array(
                    'href' => '/admin/promocoes?' . http_build_query(array(
                            'pagina' => $cont + 1,
                            'busca' => $busca
                        )),
                    'text' => $cont + 1
                ));
            }
        }

        $page = new PageCadastro();

        if($acesso == true) {

        $page->setTpl("promocoes", array(
            "promocaoSucesso"=>Promocao::getSuccess(),
            "promocaoErro"=>Promocao::getError(),
            "promocoes"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));

        } else {
            return $response->withRedirect($this->container->router->pathFor('admin'));
        }
    }

    //Tela cadastrar promoções
    public function cadastrarPromocao($request, $response){
        
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        if ($request->isGet()) {

            $page = new PageCadastro();

            if($acesso == true) {

            $page->setTpl("cadastro_promocao", array(
                "promocaoErro" => Promocao::getError()
            ));
            } else {
                return $response->withRedirect($this->container->router->pathFor('admin'));
            }
        } else {
            $promocao = new Promocao();

            $posts = $request->getParsedBody();

            if(Promocao::ckecarPromocaoExiste($posts['nome_promocao'],$posts['descricao'])=== true) {
                Promocao::setError("Promoção já cadastrada!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-promocao'));
            } else if($posts['dtinicio'] < getDataAtual()) {
                Promocao::setError("Data de Inicio precisa ser Maior ou Igual que a Data Atual");

                return $response->withRedirect($this->container->router->pathFor('cadastra-promocao'));
            } else if($posts['dtfinal'] <= getDataAtual()) {
                Promocao::setError("Data de Final precisa ser Maior que a Data Atual");

                return $response->withRedirect($this->container->router->pathFor('cadastra-promocao'));
            } else if($posts['dtfinal'] <= $posts['dtinicio'] ) {
                Promocao::setError("Data de Final precisa ser Maior que a Data de Inicio");

                return $response->withRedirect($this->container->router->pathFor('cadastra-promocao'));
            }

            try{
                $promocao->setData($posts);

                $promocao->salvarPromocao();

                $promocao->setFotoPromocao($_FILES["foto_promocao"]);

                Promocao::setSuccess("Promoção Cadastrado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('promocoes'));

            } catch (\Exception $e) {

                Promocao::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('cadastra-promocao'));
            }
        }
    }

    //Detalahar promocao
    public function detalharPromocao($request, $response, $params){
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        $promocao = new Promocao();

        $promocao->getFromPromocaoURL($params['url_promocao']);

        $page = new PageCadastro();

        if($acesso == true) {

        $page->setTpl("detalhar_promocao", array(
            "promocaoFotoSucesso"=>Promocao::getSuccess(),
            "promocao"=>$promocao->getValues()
        ));
        } else {
            return $response->withRedirect($this->container->router->pathFor('admin'));
        }
    }

    //Tela atualizar cadastro de promocao
    public function atualizarPromocao($request, $response, $params){
        Login::verifyLogin();

        $acesso =  Login::checkLogin();

        $promocao = new Promocao();

        $promocao->getPromocao((int)$params['id_promocao']);

        if ($request->isGet()) {

            $page = new PageCadastro();

            if($acesso == true) {

            $page->setTpl("atualizar_promocao", array(
                "promocaoErro" => Promocao::getError(),
                "promocao" => $promocao->getValues()
            ));

            } else {
                return $response->withRedirect($this->container->router->pathFor('admin'));
            }
        } else {
            $posts = $request->getParsedBody();

            if($posts['nome_promocao'] !== $promocao->getnome_promocao() || $posts['descricao'] !== $promocao->getdescricao()){
                if(Promocao::ckecarPromocaoExiste($posts['nome_promocao'],$posts['descricao'])=== true) {
                    Promocao::setError("Promocão já cadastrada!");

                    return $response->withRedirect($this->container->router->pathFor('atualiza-promocao',['id_promocao'=>$promocao->getid_promocao()]));

                }

            } else if($promocao->getdtinicio() >= $posts['dtfinal']) {
                Promocao::setError("Data de Final precisa ser Maior que a Data de Inicio");

                return $response->withRedirect($this->container->router->pathFor('atualiza-promocao',['id_promocao'=>$promocao->getid_promocao()]));
            }
            try{
                $promocao->setData($posts);

                $promocao->salvarPromocao();

                Promocao::setSuccess("Promocao Alterada com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('promocoes'));

            } catch (\Exception $e) {
                Promocao::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('atualiza-promocao',['id_promocao'=>$promocao->getid_promocao()]));
            }
        }
    }

    //Tela atualizar Imagem da Promocao
    public  function atualizarFotoPromocao($request, $response, $params){
        Login::verifyLogin();

        $acesso = Login::checkLogin();

        $promocao = new Promocao();

        $promocao->getPromocao((int)$params['id_promocao']);

        if ($request->isGet()) {

            $page = new PageCadastro();

            if($acesso == true) {

            $page->setTpl("atualizar_fpromocao", array(
                "promocaoFotoErro" => Promocao::getError(),
                "promocao" => $promocao->getValues()
            ));
            } else {
                return $response->withRedirect($this->container->router->pathFor('admin'));
            }

        } else {
            $posts = $request->getParsedBody();

            try{

                $promocao->setData($posts);

                $promocao->setFotoPromocao($_FILES["foto_promocao"]);

                Promocao::setSuccess("Imgagem da Promoção Alterada com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('detalha-promocao',['url_promocao'=>$promocao->geturl_promocao()]));
            } catch (\Exception $e) {

                Promocao::setError("Erro ao Alterar a imagem da Promoção!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-foto-promocao',['id_promocao'=>$promocao->getid_promocao()]));
            }
        }
    }

    //Excluir promoção
    public function excluirPromocao($request, $response, $params){
        Login::verifyLogin();

        $promocao = new Promocao();

        $promocao->getPromocao((int)$params['id_promocao']);

        try{
            $promocao->excluirPromocao();

            Promocao::setSuccess("Promoção Excluida com sucesso!");

            return $response->withRedirect($this->container->router->pathFor('promocoes'));

        } catch (\Exception $e) {
            Promocao::setError("Erro ao Excluir Promoção!");

            return $response->withRedirect($this->container->router->pathFor('promocoes'));
        }
    }

}
