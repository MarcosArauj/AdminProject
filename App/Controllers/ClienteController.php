<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/2019
 * Time: 20:29
 */

namespace App\Controllers;

use App\Models\Usuario;
use project\pages\PageCadastro;
use project\validacao\Validacao;
use App\Models\Login;
use App\Models\EstadosCidades;

class ClienteController extends Controller {

    //Tela cadastrar Cliente
    public function cadastrarCliente($request, $response){
        Login::verifyLogin();

        if ($request->isGet()) {

            $page = new PageCadastro();

            $estados = EstadosCidades::listarEstado();

            $page->setTpl("cadastro_cliente", array(
                "estados" => $estados,
//            "cidades"=>$cidades,
                "clienteErro" => Usuario::getError(),
                "clienteSucesso" => Usuario::getSuccess()
            ));
        } else {

            $cliente = new Usuario();

            $posts = $request->getParsedBody();


            if (Usuario::ckecarEmailExiste($posts['email'])=== true && Usuario::ckecarCpfExiste($posts['cpf'])=== true){

                Usuario::setError("CPF e E-mail já cadastrados!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-cliente'));

            } else if(Usuario::ckecarCpfExiste($posts['cpf'])=== true){
                Usuario::setError("CPF já cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-cliente'));

            } else if(Usuario::ckecarEmailExiste($posts['email'])=== true){
                Usuario::setError("E-mail já cadastrado!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-cliente'));

            } else if (!Validacao::validaCPF($posts["cpf"])) {
                Usuario::setError("CPF não existe!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-cliente'));

            }

            try{
                $cliente->settipo_usuario(3); //Usuario cliente
                $cliente->setData($posts);

                $cliente->salvarUsuario();

                Usuario::setSuccess("Cliente Cadastrado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('clientes'));

            } catch (\Exception $e) {

                Usuario::setError("Erro ao Cadastrar Cliente!");

                return $response->withRedirect($this->container->router->pathFor('cadastra-cliente'));
            }

        }
    }

    // Tela Cliente
    public function clientes($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $tipo_usuario = 3; //Cliente
        $paginas = array();

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
                    'href' => '/admin/clientes?' . http_build_query(array(
                            'pagina' => $cont + 1,
                            'busca' => $busca
                        )),
                    'text' => $cont + 1
                ));
            }

        }

        $page = new PageCadastro();

        $page->setTpl("clientes", array(
            "clienteSucesso"=>Usuario::getSuccess(),
            "clienteErro"=>Usuario::getError(),
            "clientes"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    // Tela buscar Cliente
    public function buscaCliente($request, $response){
        Login::verifyLogin();

        $gets = $request->getParams();

        $paginacao = null;
        $paginas = array();

        $busca = (isset($gets['busca'])) ? $gets['busca'] : "";
        $pagina = (isset($gets['pagina'])) ? (int)$gets['pagina'] : 1;
        $tipo_usuario = 3; //Cliente

        if ($busca) {

                $paginacao = Usuario::getBuscaCliente($busca,$tipo_usuario, $pagina);

                for ($cont = 0; $cont < $paginacao['paginas']; $cont++) {
                    array_push($paginas, array(
                        'href' => '/admin/clientes/buscar?' . http_build_query(array(
                                'pagina' => $cont + 1,
                                'busca' => $busca
                            )),
                        'text' => $cont + 1
                    ));
                }

            if (!$paginacao['data']) {
                Cliente::setError("Cadastra novo Cliente");
                }
            }


        $page = new PageCadastro();

        $page->setTpl("buscar_cliente", array(
            "clienteSucesso"=>Usuario::getSuccess(),
            "clienteoErro"=>Usuario::getError(),
            "clienteErroAtiva"=>Usuario::getError(),
            "clientes"=>$paginacao['data'],
            "busca"=>$busca,
            "paginas"=>$paginas
        ));
    }

    //Tela atualizar Cliente
    public function atualizarCliente($request, $response, $params){
        Login::verifyLogin();

        $cliente = new Usuario();

        $estados = EstadosCidades::listarEstado();

        $cliente->getUsuario((int)$params['id_usuario'],3);

        if ($request->isGet()) {

            $page = new PageCadastro();

            $page->setTpl("atualizar_cliente", array(
                "estados" => $estados,
                "clienteErro" => Usuario::getError(),
                "cliente" => $cliente->getValues()
            ));
        } else {

            $posts = $request->getParsedBody();

            $posts["acesso"] = (isset($posts["acesso"]))?1:0;

            try{
                $cliente->setData($posts);

                $cliente->atualizarFuncionario();

                Usuario::setSuccess("Cliente Alterado com Sucesso!");

                return $response->withRedirect($this->container->router->pathFor('cilentes'));

            } catch (\Exception $e) {

                Usuario::setError($e->getMessage());

                return $response->withRedirect($this->container->router->pathFor('atualiza-cliente',['id_usuario'=>$cliente->getid_usuario()]));
            }
        }
    }

    //Tela detalhar cadastro de Cliente
    public static function detalharCliente($request, $response, $params){
        Login::verifyLogin();

        $cliente = new Usuario();

        $cliente->getUsuario((int)$params['id_usuario'],3);

        $page = new PageCadastro();

        $page->setTpl("detalhar_cliente", array(
            "cliente"=>$cliente->getValues()
        ));

    }

    //Excluir cadastro de Cliente
    public function excluirCliente($request, $response, $params){
        Login::verifyLogin();

        $cliente = new Usuario();

        $cliente->getUsuario((int)$params['id_usuario'],3);

        try{
            $cliente->setstatus_usuario("inativo");

            $cliente->alteraStatusUsuario();

            Usuario::setSuccess("Cliente Excluido com Sucesso!");

            return $response->withRedirect($this->container->router->pathFor('clientes'));

        } catch (\Exception $e) {

            Usuario::setError("Erro ao Excluir Cliente!");

            return $response->withRedirect($this->container->router->pathFor('clientes'));
        }
    }

    //Ativa cadastro de Cliente inativado
    public function ativaCliente($request, $response, $params){

        Login::verifyLogin();

        $cliente = new Usuario();

        $cliente->getUsuario((int)$params['id_usuario'],3);

        try{
            $cliente->setstatus_usuario("ativo");

            $cliente->alteraStatusUsuario();

            Usuario::setSuccess("Sucesso ao Ativar Registro!");

            return $response->withRedirect($this->container->router->pathFor('clientes'));

        } catch (\Exception $e) {

            Usuario::setError("Erro ao Ativar Registro!");

            return $response->withRedirect($this->container->router->pathFor('buscar-cliente'));
        }

    }

}
