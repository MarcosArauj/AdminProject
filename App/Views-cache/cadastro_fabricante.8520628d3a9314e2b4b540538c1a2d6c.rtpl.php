<?php if(!class_exists('Rain\Tpl')){exit;}?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Fabricante
        </h1>
    </section>

    <!-- Main content -->
<section class="content">
    <div class="col-md-12">
    <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Fabricante</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form  role="form" action="/admin/fabricantes/cadastra" method="post">
                    <div class="box-body">
                        <div class="form-row">
                            <div class="col-md-6">
                            <label for="nome_fabricante"></label>
                            <input type="text" class="form-control"  id="nome_fabricante" name="nome_fabricante" placeholder="Fabricante de Podutos"  autofocus required>
                            <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="box-footer">
                        <div class="form-row">
                            <div class="col-md-6">
                                <input class="btn btn-primary" type="submit" value="Finalizar Cadastro">
                                <button class="btn btn-primary" type="reset">Limpar</button>
                                <a href="/admin/produtos/cadastra" class="btn btn-primary btn-md">Novo Produto</a>
                                <a href="/admin/fabricantes" class="btn btn-primary btn-md">Fabricantes</a>
                            </div>
                        </div>
                    </div>
                </form>
             </div>
                <?php if( $fabricanteSucesso != '' ){ ?>

                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $fabricanteSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>

                </div>
                <?php } ?>

                <?php if( $fabricanteErro != '' ){ ?>

                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $fabricanteErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>

                </div>
                <?php } ?>

          </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

