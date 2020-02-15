<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro de Categoria
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Categoria</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form  role="form" action="/admin/categorias/<?php echo htmlspecialchars( $categoria["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" method="post">
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Categoria de Produto</th>
                                <th style="width: 250px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control"  name="nome_categoria" value="<?php echo htmlspecialchars( $categoria["nome_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" autofocus required>
                                    <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                                </td>
                                <td style="float: right">
                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                    <a href="/admin/categorias" class="btn btn-primary btn-md">Voltar</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
            <?php if( $categoriaErro != '' ){ ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars( $categoriaErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

