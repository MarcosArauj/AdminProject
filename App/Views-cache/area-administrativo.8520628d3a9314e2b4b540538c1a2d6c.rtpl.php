<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="titulo_home">
            <b>Painel de Controle</b>


        </h1>

        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="area-administrativo"><a href="area-administrativo">Painel de Controle</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="col-md-3">
            <div class="small-box bg-olive">
                <div class="inner">
                    <h3><?php echo getNomeEmpresa(); ?></h3>
                    <p>Dados Empresa</p>
                </div>
                <div class="icon">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                </div>
                <a href="/admin/empresa/detalha/<?php echo getUrlEmpresa(); ?>" class="small-box-footer">Acessar
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>Promoções</h3>
                    <p>Controle</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">Acessar
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>Ofertas</h3>
                    <p>Controla</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">Acessar
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>Rede Sociais</h3>
                    <p>Controla</p>
                </div>
                <div class="icon">
                    <i class="fa fa-share-square" aria-hidden="true"></i>
                </div>
                <a href="#" class="small-box-footer">Acessar
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </section>
    <!--Mensagem de Sucesso-->
<!--    <?php if( $empresaSucesso != '' ){ ?>-->
<!--    <div class="alert alert-success alert-dismissible" role="alert">-->
<!--        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--        <?php echo htmlspecialchars( $empresaSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>-->
<!--    </div>-->
<!--    <?php } ?>-->


</div>
<!-- /.content-wrapper -->

