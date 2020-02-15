<?php if(!class_exists('Rain\Tpl')){exit;}?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro - Cargo de Funcio&aacute;rios
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/cargos">Cargos</a></li>
            <li class="active"><a href="/admin/cargos/cadastrar">Cadastrar</a></li>
        </ol>
    </section>

    <!-- Main content -->
<section class="content">
    <div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
                    <h3 class="box-title">Novo Cargo</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form  role="form" action="/admin/cargos/cadastra" method="post">
                    <div class="box-body">
                        <div class="box-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="cargo"></label>
                                    <input type="text" class="form-control"  id="cargo" name="cargo" placeholder="Cargo do Funcionário" autofocus required>
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
                                    <a href="/admin/funcionarios/cadastra" class="btn btn-primary btn-md">Novo Funcionário</a>
                                    <a href="/admin/cargos" class="btn btn-primary btn-md">Cargos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php if( $cargoSucesso != '' ){ ?>

            <div class="alert alert-success">
                <?php echo htmlspecialchars( $cargoSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>

            </div>
            <?php } ?>

            <?php if( $cargoErro != '' ){ ?>

            <div class="alert alert-danger">
                <?php echo htmlspecialchars( $cargoErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>

            </div>
            <?php } ?>

    </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

