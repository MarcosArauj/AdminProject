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
            <li><a href="/admin/produtos">Produtos</a></li>
            <li class="active"><a href="/admin/produtos/cadastra">Cadastrar</a></li>
        </ol>
    </section>

    <!-- Main content -->
<section class="content">
    <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Novo Produto</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/admin/produtos/cadastra" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                      <div class="form-row">
                        <div class="col-md-4">
                            <label for="nome_produto">Produto</label>
                            <input type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="Produto" autofocus required>
                        </div>
                          <div  class="col-md-2">
                              <label for="fabricante_id"><a href="/admin/fabricantes/cadastra">Novo Fabricante</a></label>
                                  <select class="form-control" name="fabricante_id" id="fabricante_id" required>
                                      <option value="">Fabricante... </option>
                                      <?php $counter1=-1;  if( isset($fabricantes) && ( is_array($fabricantes) || $fabricantes instanceof Traversable ) && sizeof($fabricantes) ) foreach( $fabricantes as $key1 => $value1 ){ $counter1++; ?>

                                      <option value="<?php echo htmlspecialchars( $value1["id_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_fabricante"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                      <?php } ?>

                                  </select>
                          </div>
                          <div class="col-md-2">
                              <label for="categoria_id"><a href="/admin/categorias/cadastra">Nova Categoria</a></label>
                                <select class="form-control" name="categoria_id" id="categoria_id" required>
                                    <option value="">Categoria... </option>
                                    <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>

                                    <option value="<?php echo htmlspecialchars( $value1["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["nome_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                    <?php } ?>

                                </select>
                          </div>
                      </div>
                          <div class="form-row">
                            <div class="col-md-2">
                                <label for="preco">Preço Unitário</label>
                                <input type="number" class="form-control" id="preco" name="preco" step="0.01" placeholder="0.00" required>
                            </div>
                              <div class="col-md-2">
                                  <label for="quantidade">Quantidade</label>
                                  <input type="number" class="form-control" id="quantidade" name="quantidade" step="0.01" placeholder="0.00" required>
                              </div>

                            <div class="col-md-4">
                                <label for="descricao">Descrição do Produto</label>
                                <textarea name="descricao" class="form-control" id="descricao" placeholder="Digite aqui..." required></textarea>
                            </div>
                             <div class="col-md-4">
                                 <label for="url">Url</label>
                                 <input type="text" class="form-control" id="url" name="url" placeholder="url-exemplo" required>
                             </div>
                            <div class="col-md-4">
                                <label for="foto_produto">Imagem</label>
                                <input type="file" class="btn btn-default" id="foto_produto" name="foto_produto" required>
                                <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                            </div>
                          </div>
                       </div>
                      <br>
                      <br>
                      <div class="box-footer">
                      <div class="form-row">
                          <div class="col-md-6">
                              <button class="btn btn-primary" type="submit">Finalizar Cadastro</button>
                              <button class="btn btn-primary" type="reset">Limpar</button>
                              <a href="/admin/produtos" class="btn btn-primary btn-md">Produtos</a>
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


