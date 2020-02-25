

// Mostrar e ocultar senhas
jQuery(document).ready(function($) {

        $('#mostrar_senha').click(function(e) {
            e.preventDefault();
            if ( $('#senha').attr('type') == 'password') {
                $('#senha').attr('type', 'text');
                $('#mostrar_senha').attr('class', 'fa fa-eye');
            } else {
               $('#senha').attr('type', 'password');
                $('#mostrar_senha').attr('class', 'fa fa-eye-slash');
            }

        });

    $('#mostrar_senha_alterar').click(function(e) {
        e.preventDefault();
        if ( $('#novasenha').attr('type') == 'password' || $('#confirmasenha').attr('type') == 'password' ||
            $('#senhatual').attr('type') == 'password' ) {

            $('#senhatual').attr('type', 'text');
            $('#novasenha').attr('type', 'text');
            $('#confirmasenha').attr('type', 'text');
            $('#mostrar_senha_alterar').val('Ocultar Senhas');
        } else {
            $('#senhatual').attr('type', 'password');
            $('#novasenha').attr('type', 'password');
            $('#confirmasenha').attr('type', 'password');
            $('#mostrar_senha_alterar').val('Mostrar Senhas');
        }

    });

});


// Carregar endereço buscando pelo CEP
$('#cep').blur(function (e) {
  // console.log("saiu");

    var cep = $('#cep').val();
   // console.log(cep);
    var url = "http://viacep.com.br/ws/" + cep + "/json"

    pesquisarCEP(url);

});

function pesquisarCEP(endereco) {
    $.ajax({
        type:"GET",
        url:endereco,
        async:false

    }).done(function (data) {
        console.log(data);
        $('#bairro').val(data.bairro);
        $('#endereco').val(data.logradouro);
        $('#cidade').val(data.localidade);
        $('#estado').val(data.uf);
    }).fail(function () {
        console.log("Erro");
    });
}


// $(document).ready( function() {
//
//     $( "#loading" ).hide();
//
//     $("#seleciona-estado").change(function(){
//
//         $.ajax({
//             "type": "POST",
//             "url" : "http://admin.projectcn.com.br/admin/funcionarios/salvar",
//             data: {title:$(this).val()} ,
//             "success" : function(data){
//
//                 $("#resultado-cidade").html(data);
//
//
//             }
//
//
//         });
//         return false;
//
//     });
//     $( document ).ajaxStart(function() {
//         $( "#loading" ).show();
//     }).ajaxStop(function() {
//         $( "#loading" ).hide();
//     });
// });

// //quando o valor da combo de estado alterar ele vai executar essa linha
// $('#id_estado').change(function () {
//     //armazenando o valor do codigo do estado
//     var valor = document.getElementById("id_estado").value;
//     //chamada da controller e passando o ID estado via GET
//     $.get('/admin/funcionarios/salvar' + valor, function (data) {
//         //procurando a tag OPTION com id da cidade e removendo
//         $('#id_cidade').find("option").remove();
//         //motando a combo da cidade
//         $('#id_cidade').append(data);
//     });
// });



