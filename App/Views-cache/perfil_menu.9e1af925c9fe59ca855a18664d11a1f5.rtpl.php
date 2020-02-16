<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="list-group" id="menu">
    <a href="/admin" class="list-group-item list-group-item-action fade in"><b>P&aacute;gina Inicial</b></a>
    <?php if( getTipoUsuario() != 1 ){ ?>
    <a href="/perfil/atualiza" class="list-group-item list-group-item-action fade in"><b>Alterar Dados</b></a>
    <?php }else{ ?>
    <a href="/proprietario/atualiza" class="list-group-item list-group-item-action fade in"><b>Alterar Dados</b></a>
    <?php } ?>
    <a href="/perfil/altera_senha" class="list-group-item list-group-item-action fade in"><b>Alterar Senha</b></a>
    <a href="" class="list-group-item list-group-item-action fade in" data-toggle="modal" data-target="#ModalSair">
        <span class="glyphicon glyphicon-log-out"><b> Sair </b></span></a>

</div>
<!-- Modal Sair -->
<div class="modal fade" id="ModalSair" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" id="titulo_home"><b><?php echo getNomeEmpresaCompleto(); ?></b></h3>
            </div>
            <div class="modal-body">
                <p><b><?php echo getNomeUsuario(); ?>, certeza que deseja sair do Sistema?</b></p>
            </div>
            <div class="modal-footer">
                <a href="/logout" class="btn btn-danger">&nbsp;<strong>Sair</strong></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>
