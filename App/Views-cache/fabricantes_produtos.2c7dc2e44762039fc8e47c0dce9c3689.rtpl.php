<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Produtos do Fabricante <?php echo htmlspecialchars( $fabricante["nome_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/fabricantes">Fabricantes</a></li>
            <li><a href="/admin/fabricantes/<?php echo htmlspecialchars( $fabricante["id_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/produtos"><?php echo htmlspecialchars( $fabricante["nome_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Todos os Produtos</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                            <?php if( $fabricanteErro != '' ){ ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars( $fabricanteErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                            </div>
                            <?php }else{ ?>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Produto</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                            </tr>
                            <?php } ?>
                            </thead>
                            <tbody>
                            <?php $counter1=-1;  if( isset($fabricanteProdutos) && ( is_array($fabricanteProdutos) || $fabricanteProdutos instanceof Traversable ) && sizeof($fabricanteProdutos) ) foreach( $fabricanteProdutos as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $value1["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["nome_produto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["nome_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["preco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["quantidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="/admin/fabricantes" class="btn btn-primary btn-md">Voltar</a>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->