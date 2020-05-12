<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro de Fabricante
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/users">Categorias</a></li>
            <li class="active"><a href="/admin/fabricantes/cadastra">Cadastrar</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Novo Fabricante</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form  role="form" action="/admin/fabricantes/<?php echo htmlspecialchars( $fabricante["id_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" method="post">
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Fabricante de Produto</th>
                                <th style="width: 250px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control"  name="nome_fabricante" placeholder="Fabricante de Podutos"  value="<?php echo htmlspecialchars( $fabricante["nome_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" autofocus required>
                                    <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                                </td>
                                <td style="float: right">
                                    <button class="btn btn-primary" type="submit">Autalizar</button>
                                    <a href="/admin/fabricantes" class="btn btn-primary btn-md">Voltar</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                <?php if( $fabricanteErro != '' ){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $fabricanteErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

