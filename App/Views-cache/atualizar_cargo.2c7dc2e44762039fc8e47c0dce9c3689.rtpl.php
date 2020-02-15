<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro - Cargo de Funcion&aacute;rios
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Cargo</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form  role="form" action="/admin/cargos/<?php echo htmlspecialchars( $cargo["id_cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" method="post">
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Cargo de Funcion&aacute;rios</th>
                                <th style="width: 250px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control"  name="cargo" value="<?php echo htmlspecialchars( $cargo["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" autofocus required>
                                    <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                                </td>
                                <td style="float: right">
                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                    <button class="btn btn-primary" type="reset">Limpar</button>
                                    <a href="/admin/cargos" class="btn btn-primary btn-md">Voltar</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
            <?php if( $cargoErro != '' ){ ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars( $cargosErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

