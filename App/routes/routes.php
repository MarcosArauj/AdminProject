<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 19/04/2019
 * Time: 10:56
 */

//Rota tela de Inicial/home
$app->map(['GET', 'POST'],'/', 'LoginController:login')->setName('home');
//Rota que carregar a Tela de Admin após logar
$app->get('/admin', 'LoginController:admin')->setName('admin');
//Rota logout
$app->get('/logout', 'LoginController:logout')->setName('logout');

//Proprietario
$app->group('/proprietario', function (){
    //Rota cadastro do Proprietario/Usuario
    $this->map(['GET', 'POST'],'/cadastra', 'ProprietarioController:cadastrarProprietario')->setName('cadastrar-proprietario');
    //Rota carregar tela altualizar perfil
    $this->map(['GET', 'POST'],'/atualiza', 'ProprietarioController:atualizaProprietario')->setName('atualiza-proprietario');
});

//Perfil Usuario Logado
$app->group('/perfil', function (){
    //Rota carregar tela perfil usuario
    $this->get('', 'UsuarioController:perfil')->setName('perfil');
    //Rota altualizar perfil
    $this->map(['GET', 'POST'],'/atualiza', 'UsuarioController:atualizaPerfil')->setName('atualiza-perfil');
    //Rota alterar Senha
    $this->map(['GET', 'POST'],'/altera_senha', 'UsuarioController:alteraSenha')->setName('atualiza-senha');
});

//Recupera Senha
$app->group('/recupera-senha/esqueci', function () {
    // Envia email
    $this->map(['GET', 'POST'], '', 'RecuperaSenhaController:esqueciSenha')->setName('esqueci-senha');
    //Email enviado
    $this->get('/enviado', 'RecuperaSenhaController:emailEnviado')->setName('email-enviado');
    //Recupera Senha
    $this->map(['GET', 'POST'], '/recupera', 'RecuperaSenhaController:recuperaSenha')->setName('recupera-senha');
});

//Administrativo
$app->group('/admin', function ($app){
    //Empresa
    $app->group('/empresa', function () {
        //Rota cadastrar empresa
        $this->map(['GET', 'POST'], '/cadastra', 'EmpresaController:cadastrarEmpresa')->setName('cadastra-empresa');
        //Detalha cadastro da Empresa
        $this->get('/detalha/{url_empresa}', 'EmpresaController:empresa')->setName('empresa');
        //Rota atualiar o cadastro da empresa
        $this->map(['GET', 'POST'], '/atualiza/{id_empresa}', 'EmpresaController:atualizarEmpresa')->setName('atualizar-empresa');
    });
    //Funcionario
    $app->group('/funcionarios', function(){
        //Rota carregar lista de Funcionários
        $this->get('', 'FuncionarioController:funcionarios')->setName('funcionarios');
        //Rota detalhar cadastro do Funcionário/Usurio
        $this->get('/{id_usuario}/detalha', 'FuncionarioController:detalharFuncionario')->setName('detalha-funcionario');
        //Rota Buscar Funcionario
        $this->get('/buscar', 'FuncionarioController:buscaFuncionario')->setName('buscar-funcionario');
        //Rota ativar Funcionario/Usuario
        $this->get('/buscar/{id_usuario}/ativa', 'FuncionarioController:ativaFuncionario')->setName('ativa-funcionario');
        //Rota cadastro de Funcionario/Usuario
        $this->map(['GET', 'POST'], '/cadastra', 'FuncionarioController:cadastrarFuncionario')->setName('cadastra-funcionario');
        //Rota atualizar Funcionário
        $this->map(['GET', 'POST'], '/{id_usuario}/atualiza', 'FuncionarioController:atualizarFuncionario')->setName('atualiza-funcionario');
        //Rota excluir Funcionario/Usuario
        $this->get('/{id_usuario}/exclui', 'FuncionarioController:excluirFuncionario')->setName('exclui-funcionario');
    });
    //Fornecedor
    $app->group('/fornecedores', function(){
        //Rota carregar tela listar fornecedores
        $this->get('', 'FornecedorController:fornecedores')->setName('fornecedores');
        //Rota caregar tela de detalhar cadastro do Fornecedor
        $this->get('/{id_fornecedor}/detalha', 'FornecedorController:detalharFornecedor')->setName('detalha-fornecedor');
        //Rota carrega tela Buscar Fornecedor
        $this->get('/buscar', 'FornecedorController:buscaFornecedor')->setName('buscar-fornecedor');
        //Rota ativar Fornecedor
        $this->get('/buscar/{id_fornecedor}/ativa', 'FornecedorController:ativaFornecedor')->setName('ativar-fornecedor');
        //Rota cadastrar Fornecedor
        $this->map(['GET', 'POST'], '/cadastra', 'FornecedorController:cadastrarFornecedor')->setName('cadastra-fornecedor');
        //Rota atualizar do Fornecdor
        $this->map(['GET', 'POST'], '/{id_fornecedor}/atualiza', 'FornecedorController:atualizarFornecedor')->setName('atualiza-fornecedor');
        //Rota excluir Fornecedor
        $this->get('/{id_fornecedor}/exclui', 'FornecedorController:excluirFornecedor')->setName('exclui-fornecedor');
    });
    //Categoria Produto
    $app->group('/categorias', function(){
        //Rota listar categorias
        $this->get('', 'CategoriaController:categorias')->setName('categorias');
        //Rota cadastrar categorias
        $this->map(['GET', 'POST'], '/cadastra', 'CategoriaController:cadastrarCategoria')->setName('cadastra-categoria');
        //tela atualizar categoria
        $this->map(['GET', 'POST'], '/{id_categoria}/atualiza', 'CategoriaController:aualizarCategoria')->setName('atualiza-categoria');
        //Rota carregar tela Produtos relacionados a categorias
        $this->get('/{id_categoria}/produtos', 'CategoriaController:categoriaProduto')->setName('categoria-produtos');
        //Rota Excluir Categoria
        $this->get('/{id_categoria}/exclui', 'CategoriaController:excluirCategoria')->setName('exclui-categoria');
    });
    //Fabricante Produto
    $app->group('/fabricantes', function(){
        //Rota listar fabricantes
        $this->get('', 'FabricanteController:fabricantes')->setName('fabricantes');
        //Rota cadastrar fabricantes
        $this->map(['GET', 'POST'], '/cadastra', 'FabricanteController:cadastrarFabricante')->setName('cadastra-fabricante');
        //tela atualizar fabricantes
        $this->map(['GET', 'POST'], '/{id_fabricante}/atualiza', 'FabricanteController:aualizarFabricante')->setName('atualiza-fabricante');
        //Rota carregar tela Produtos relacionados a fabricantes
        $this->get('/{id_fabricante}/produtos', 'FabricanteController:fabricanteProduto')->setName('fabricante-produtos');
        //Rota Excluir fabricantes
        $this->get('/{id_fabricante}/exclui', 'FabricanteController:excluirFabricante')->setName('exclui-fabricantes');
    });
    //Produto
    $app->group('/produtos', function(){
        //Rota listar produtos
        $this->get('', 'ProdutoController:produtos')->setName('produtos');
        //Rota detalhar produto
        $this->get('/{url}/detalha', 'ProdutoController:detalharProduto')->setName('detalha-produto');
        //Rota cadastrar produtos
        $this->map(['GET', 'POST'], '/cadastra', 'ProdutoController:cadastrarProduto')->setName('cadastra-produto');
        //Rota atualizar produto
        $this->map(['GET', 'POST'], '/{id_pcf}/atualiza', 'ProdutoController:atualizarProduto')->setName('atualiza-produto');
        //Rota atualizar foto do produto produto
        $this->map(['GET', 'POST'], '/{id_pcf}/fotoProduto', 'ProdutoController:atualizarFotoProduto')->setName('atualiza-foto-produto');
        //Rota Excluir Produto
        $this->get('/{id_pcf}/exclui', 'ProdutoController:excluirProduto')->setName('exclui-produto');
    });
});





