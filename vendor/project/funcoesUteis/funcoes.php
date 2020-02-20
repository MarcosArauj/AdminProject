<?php

use App\Models\Login;
use App\Models\Empresa;

function formatPreco($preco){

    return number_format($preco, 2 ,",",".");

}

function formatData($data){

    return date('d/m/Y',strtotime($data));

}

function formataCpf($cpf){

    $parte_um     = substr($cpf, 0, 3);
    $parte_dois   = substr($cpf, 3, 3);
    $parte_tres   = substr($cpf, 6, 3);
    $parte_quatro = substr($cpf, 9, 2);

    $cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

    return $cpf;

}

function formataCnpj($cnpj){

    $parte_um     = substr($cnpj, 0, 2);
    $parte_dois   = substr($cnpj, 2, 3);
    $parte_tres   = substr($cnpj, 5, 3);
    $parte_quatro = substr($cnpj, 8, 4);
    $parte_cinco  = substr($cnpj, 12, 2);

    $cnpj = "$parte_um.$parte_dois.$parte_tres/$parte_quatro-$parte_cinco";

    return $cnpj;

}


function checarLogin($acesso = true) {

   return Login::checkLogin($acesso);

}

function getNomeUsuario() {
    $usuario = Login::getFromSession();

    return $usuario->getprimeiro_nome();
}

function getIniciaisUsuario(){
    $usuario = Login::getFromSession();

    $iniciais_nome = substr($usuario->getprimeiro_nome(), 0, 2);

    return mb_strtoupper($iniciais_nome);
}

function getTipoUsuario() {
    $usuario = Login::getFromSession();

    return $usuario->getid_usuario();
}

function getEmpresa(){
    $empresa = Empresa::chegarEmprsa();

    return $empresa;
}

function getNomeEmpresa(){
    $empresa = new Empresa();

    $empresa->dadosempresa();

    $nome = $empresa->getnome_curto();

    if($nome == null) {
        $nome = "Nome da Empresa";
    }

    return utf8_encode($nome);
}

function getNomeEmpresaCompleto(){
    $empresa = new Empresa();

    $empresa->dadosempresa();

    $nome = $empresa->getnome_fantasia();

    if($nome == null) {
        $nome = "Gentileza Cadastrar sua Empresa no Sistema";
    }

    return utf8_encode($nome);
}

function getUrlEmpresa(){
    $empresa = new Empresa();

    $empresa->dadosempresa();

    $nome = $empresa->geturl_empresa();

    return $nome;
}
