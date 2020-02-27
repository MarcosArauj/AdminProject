<?php

//Iniciar dna Sessão
session_start();

date_default_timezone_set('America/Sao_Paulo');

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require_once 'vendor/autoload.php';

use \Slim\Slim;

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$container = $app->getContainer();

function getControllers($container, array $names) {
    foreach ($names as $name) {
        $container[$name] = function($container) use($name) {
            $namespace = "App\\Controllers\\$name";
            return new $namespace($container);
        };
    }

    return $container;
}

getControllers($container, array(
    'LoginController',
    'UsuarioController',
    'RecuperaSenhaController',
    'ProprietarioController',
    'EmpresaController',
    'FuncionarioController',
    'ClienteController',
    'FornecedorController',
    'CategoriaController',
    'FabricanteController',
    'ProdutoController',
    'PromocaoController'
));

// Funções Uteis
require_once 'vendor/project/funcoesUteis/funcoes.php';

// Rotas
require_once 'App/routes/routes.php';

