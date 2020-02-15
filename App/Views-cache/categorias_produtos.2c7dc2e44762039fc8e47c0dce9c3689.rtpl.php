<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Produtos da Categoria <?php echo htmlspecialchars( $categoria["nome_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/categorias">Categorias</a></li>
            <li><a href="/admin/categorias/<?php echo htmlspecialchars( $categoria["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/produtos"><?php echo htmlspecialchars( $categoria["nome_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
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
                            <?php if( $categoriaErro != '' ){ ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars( $categoriaErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                            </div>
                            <?php }else{ ?>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Produto</th>
                                <th>Fabricante</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                            </tr>
                            <?php } ?>
                            </thead>
                            <tbody>
                            <?php $counter1=-1;  if( isset($categoriaProdutos) && ( is_array($categoriaProdutos) || $categoriaProdutos instanceof Traversable ) && sizeof($categoriaProdutos) ) foreach( $categoriaProdutos as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $value1["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["nome_produto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["nome_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>R$ <?php echo formatPreco($value1["preco"]); ?></td>
                                <td><?php echo htmlspecialchars( $value1["quantidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="/admin/categorias" class="btn btn-primary btn-md">Voltar</a>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->