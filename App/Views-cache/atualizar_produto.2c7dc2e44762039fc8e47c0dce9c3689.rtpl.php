<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro de Produto
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/admin/produtos">Produtos</a></li>
            <li class="active"><a href="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha"><?php echo htmlspecialchars( $produto["nome_produto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
            <li class="active"><a href="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza">Editar Produto</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Produto</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" method="post">
                    <div class="box-body">
                        <div class="form-row">
                               <div class="col-md-4">
                                    <label for="nome_produto">Produto</label>
                                    <input type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="Produto" value="<?php echo htmlspecialchars( $produto["nome_produto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                               </div>
                             <div class="col-md-2">
                                <label for="preco">Preço Unitário</label>
                                <input type="number" class="form-control" id="preco" name="preco" step="0.01" placeholder="0.00" value="<?php echo htmlspecialchars( $produto["preco"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                              </div>
                                <div class="col-md-3">
                                <label for="fabricante_id">Fabricante</label>
                                <select class="form-control" name="fabricante_id" id="fabricante_id">
                                    <option style="color:blue" value="<?php echo htmlspecialchars( $produto["id_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $produto["nome_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                    <?php $counter1=-1;  if( isset($fabricantes) && ( is_array($fabricantes) || $fabricantes instanceof Traversable ) && sizeof($fabricantes) ) foreach( $fabricantes as $key1 => $value1 ){ $counter1++; ?>
                                    <option value="<?php echo htmlspecialchars( $value1["id_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                    <?php } ?>
                                </select>
                               </div>
                               <div class="col-md-3">
                                <label for="categoria_id">Categoria</label>
                                <select class="form-control" name="categoria_id" id="categoria_id">
                                    <option style="color:blue" value="<?php echo htmlspecialchars( $produto["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $produto["nome_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                    <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>
                                    <option value="<?php echo htmlspecialchars( $value1["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                    <?php } ?>
                                </select>
                               </div>

                         <br>
                            <div class="col-md-6">
                                <label for="descricao">Descrição do Produto</label>
                                <textarea name="descricao" class="form-control" id="descricao" value="" required><?php echo htmlspecialchars( $produto["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                                <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="box-footer">
                        <div class="form-row">
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i>Atualizar</button>
                                <a href="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha" class="btn btn-primary"><i class="fa fa-edit"></i> Detalhar</a>
                                <a href="/admin/produtos" class="btn btn-primary btn-md">Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php if( $produtoErro != '' ){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo htmlspecialchars( $produtoErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

