<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detalhes da Promoção
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/empresa/area-administrativo"> Painel de Controle</a></li>
            <li><a href="/admin/promocoes">Promoções</a></li>
            <li class="active"><a href="/admin/promocoes/<?php echo htmlspecialchars( $promocao["id_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha">Detalhar </a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box box-success">
                <div class="box-body">
                    <div class="col-sm-6">
                        <div class="product-images">
                            <div class="product-main-img">
                                <img width="300px"  src="<?php echo htmlspecialchars( $promocao["foto_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title"><?php echo htmlspecialchars( $promocao["nome_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
                            </div>
                            <div class="panel-body">
                                <label>Data de Início: </label>
                                <span><?php echo formatData($promocao["dtinicio"]); ?></span>
                                <br>
                                <label>Data Final:  </label>
                                <span><?php echo formatData($promocao["dtfinal"]); ?></span>
                                <br>
                                <label>Descrição: </label>
                                <span><?php echo htmlspecialchars( $promocao["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>

                            </div>
                        </div>
                    </div>
                </div>

                    <div class="box-footer">
                        <div class="form-row">
                            <div class="col-md-6">
                                <a href="/admin/promocoes/<?php echo htmlspecialchars( $promocao["id_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/fotoPromocao" class="btn btn-primary btn-md"><i class="fa fa-edit"></i>Atualizar Foto</a>
                                <a href="/admin/promocoes/<?php echo htmlspecialchars( $promocao["id_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-md"><i class="fa fa-edit"></i>Editar Promoção</a>
                                <a href="/admin/promocoes" class="btn btn-primary btn-md">Voltar</a>
                            </div>
                        </div>
                    </div>
            </div>
        <?php if( $promocaoFotoSucesso != '' ){ ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo htmlspecialchars( $promocaoFotoSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

