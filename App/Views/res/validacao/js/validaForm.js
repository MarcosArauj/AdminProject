
function RemoveMascar(str, sub) {

   var i = str.indexOf(sub);
   var r = "";

    if (i == -1) return str;
    {
        r += str.substring(0,i) + RemoveMascarCpf(str.substring(i + sub.length), sub);
    }

    return r;
}

function Verifica_cpf(cpf){

    var numeros, soma, digitos, i, resultado, digitos_iguais;
    digitos_iguais = 1;

    cpf = RemoveMascar(cpf, ".");
    cpf = RemoveMascar(cpf, "-");

    if (cpf.length < 11)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1))
        {
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais) {

        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);


        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
        return true;
    }
    else
        return false;
}

function ValidaCampoCpf(){

    if(Verifica_cpf(document.FormCadastro.cpf.value))
        document.getElementById("cpf").setAttribute("class", "has-success col-md-6");
    else
        document.getElementById("cpf").setAttribute("class", "has-error col-md-6");
}




function ValidarCampoDeSenha() {

    if(document.FormAlteraSenha.confirma_senha.value != document.FormAlteraSenha.nova_senha.value) {
        document.getElementById("confirma_senha").setAttribute("class", " has-error");
        document.getElementById("nova_senha").setAttribute("class", "has-error");

    } else if(document.FormAlteraSenha.confirma_senha.value == document.FormAlteraSenha.nova_senha.value) {
        document.getElementById("confirma_senha").setAttribute("class", "has-success");
        document.getElementById("nova_senha").setAttribute("class", "has-success");

    }

    if(document.FormAlteraSenha.nova_senha.value == document.FormAlteraSenha.senha_atual.value) {
        document.getElementById("nova_senha").setAttribute("class", "has-error");
    }

    if(document.FormAlteraSenha.nova_senha.value != document.FormAlteraSenha.senha_atual.value) {
        document.getElementById("nova_senha").setAttribute("class", "has-success");
    }


}

function ValidarCampoEmail() {

    var email = document.FormCadastro.email.value;
    var validarEmail = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;

    if(validarEmail.test(email) == false) {
        document.getElementById("email").setAttribute("class", "has-error");

    } else  if (validarEmail.test(email) == true){
        document.getElementById("email").setAttribute("class", "has-success");
    }
}


///----PIS---------//
/*
Validador PIS/PASEP
Por Douglas J. Paula
dougbr_4x4@hotmail.com
Este script foi criado utilizando como base
o Validador PIS/PASEP em ASP de Gabriel Fróes
disponível em www.codigofonte.com.br
*/


function ChecaPIS(pis) {

    total=0;
    resto=0;
    numPIS=0;
    strResto="";

    numPIS=pis;


    numPIS = RemoveMascar(numPIS, ".");
    numPIS = RemoveMascar(numPIS, "-");

    if (numPIS=="" || numPIS==null) {
        return false;
    }

    for(i=0; i<=9; i++) {
        resultado = (numPIS.slice(i,i+1))*(ftap.slice(i,i+1));
        total=total+resultado;
    }

    resto = (total % 11)

    if (resto != 0) {
        resto=11-resto;
    }

    if (resto==10 || resto==11) {
        strResto=resto+"";
        resto = strResto.slice(1,2);
    }

    if (resto!=(numPIS.slice(10,11))) {
        return false;
    }

    return true;
}

function ValidarPis() {

    if (ChecaPIS(document.FormCadastro.pis.value))
    {
        document.getElementById("pis").setAttribute("class", "has-error col-md-6");
    } else {
        document.getElementById("pis").setAttribute("class", "has-success  col-md-6");
    }
}

function ValidaFormCategoria(){
    var formulario = document.forms["FormCategoria"];

    formulario.nome_categoria.value;

    // return false;
}