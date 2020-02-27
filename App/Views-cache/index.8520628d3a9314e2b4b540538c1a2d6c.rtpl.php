<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="titulo_home">
            <b>Painel de Controle</b>


        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>


    <section class="content">
        <div class="col-md-4">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>Controle</h3>
                    <p>Estoque</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">Acessar
                <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>Relatórios</h3>
                    <p>Sistemas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">Acessar
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php if( checarLogin() ){ ?>
        <div class="col-md-4">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?php echo getNomeEmpresa(); ?></h3>
                    <p><?php echo getNomeEmpresaCompleto(); ?> </p>
                </div>
                <div class="icon">
                    <i class="fa fa-cog"></i>
                </div>
                <?php if( getEmpresa() > 0 ){ ?>
                <a href="/admin/empresa/area-administrativo" class="small-box-footer">Acessar
                    <i class="fa fa-arrow-circle-right"></i></a>
                <?php }else{ ?>
                <a href="/admin/empresa/cadastra" class="small-box-footer">Acessar
                    <i class="fa fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>
        <?php }else{ ?>
        <div class="col-md-4">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>Outras</h3>
                    <p>Opções</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cog"></i>
                </div>
                <a href="#" class="small-box-footer">Acessar
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php } ?>
    </section>
    <!--Mensagem de Sucesso-->
    <?php if( $empresaSucesso != '' ){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo htmlspecialchars( $empresaSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>
    </div>
    <?php } ?>


</div>
<!-- /.content-wrapper -->
