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
            <li class="active"><a href="/admin/produtos">Produtos</a></li>
            <li class="active"><a href="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha"><?php echo htmlspecialchars( $produto["nome_produto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box box-success">
                <div class="box-body">
                    <div class="col-sm-6">
                        <div class="product-images">
                            <div class="product-main-img">
                                <img width="300px"  src="<?php echo htmlspecialchars( $produto["foto_produto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title"><?php echo htmlspecialchars( $produto["nome_produto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
                            </div>
                            <div class="panel-body">
                                <label>Fabricante: </label>
                                <span><?php echo htmlspecialchars( $produto["nome_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Categoria:  </label>
                                <span><?php echo htmlspecialchars( $produto["nome_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Valor:  </label>
                                <span><?php echo htmlspecialchars( $produto["preco"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Descrição: </label>
                                <span><?php echo htmlspecialchars( $produto["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Quantidade em Estoque: </label>
                                <span><?php echo htmlspecialchars( $produto["quantidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>

                            </div>
                        </div>
                    </div>
                </div>

                    <div class="box-footer">
                        <div class="form-row">
                            <div class="col-md-6">
                                <a href="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/fotoProduto" class="btn btn-primary btn-md"><i class="fa fa-edit"></i>Atualizar Foto</a>
                                <a href="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-md"><i class="fa fa-edit"></i>Editar Produto</a>
                                <a href="/admin/produtos" class="btn btn-primary btn-md">Voltar</a>
                            </div>
                        </div>
                    </div>
            </div>
        <?php if( $produtoFotoSucesso != '' ){ ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo htmlspecialchars( $produtoFotoSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

