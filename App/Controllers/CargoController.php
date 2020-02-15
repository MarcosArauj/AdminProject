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
use App\Models\Cargo;
use Slim\CallableResolver;

class CargoController extends Controller {

    ///Carrega tela de cargos
    public static function cargos($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;


        if($busca != ''){
            $paginacao = Cargo::getPageBusca($busca);
        } else {
            $paginacao = Cargo::getPage($pagina);
        }

        $paginas = array();

        for ($cont = 0; $cont < $paginacao['paginas']; $cont++){
            array_push($paginas, array(
                'href'=>'/admin/cargos?'.http_build_query(array(
                        'pagina'=>$cont+1,
                        'busca'=>$busca
                    )),
                'text'=>$cont+1
            ));
        }

        $page = new PageCadastro();

        $page->setTpl("cargos", array(
            "cargoSucesso"=>Cargo::getSuccess(),
            "cargoErro"=>Cargo::getError(),
            "cargos"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    // Carregar tela de cadastro de cargos
    public function cadastrarCargo($request, $response){
        Login::verifyLogin();

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("cadastro_cargo", array(
                "cargoSucesso" => Cargo::getSuccess(),
                "cargoErro" => Cargo::getError()
            ));
        } else {

            $cargo= new Cargo();

            $posts = $request->getParsedBody();

            if(Cargo::ckecarCargoExiste($posts['cargo'])=== true) {
                Cargo::setError("Cargo j&aacute; cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-cargo'));
            }
            try{

                $cargo->setData($posts);

                $cargo->salvarCargo();

                Cargo::setSuccess("Cargo Cadastrado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('cargos'));

            } catch (\Exception $e) {

                Cargo::setError("Erro ao Cadastrar Cargo Produto!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-cargo'));
            }
        }
    }

    // Carregar tela de atualizar cargos
    public function aualizarCargo($request, $response, $params){

        Login::verifyLogin();

        $cargo = new Cargo();

        $cargo->get((int)$params['id_cargo']);

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("atualizar_cargo", array(
                "cargo" => $cargo->getValues(),
                "cargoErro" => Cargo::getError()
            ));
        } else {

            $posts = $request->getParsedBody();

            if($posts['cargo'] !== $cargo->getcargo()){
                if(Cargo::ckecarCargoExiste($_POST['cargo'])=== true) {
                    Cargo::setError("Cargo já; cadastrado!");

                    return $response->withRedirect($this->container->router->pathFor('atualiza-cargo',['id_cargo'=>$cargo->getid_cargo()]));
                }

            }
            try{

                $cargo->setData($posts);

                $cargo->salvarCargo();

                Cargo::setSuccess("Cargo Alterado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('cargos'));

            } catch (\Exception $e) {

                Cargo::setError("Erro ao Alterar Cargo!");

                return $response->withRedirect($this->container->router->pathFor('atualiza-cargo',['id_cargo'=>$cargo->getid_cargo()]));
            }
        }
    }

    //Excluir Cargo
    public function excluirCargo($id_cargo){
        Login::verifyLogin();

        $cargo = new Cargo();

        $cargo->get((int)$id_cargo);

        try{

            $cargo->excluir();

            Cargo::setSuccess("Cargo Excluido com Sucesso!");

            header("Location: /admin/cargos");
            exit;

        } catch (\Exception $e) {

            Categoria::setError("Erro ao Excluir Cargo!");

            header("Location: /admin/cargos");
            exit;
        }
    }

}