<?php if(!class_exists('Rain\Tpl')){exit;}?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro de Promções
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/empresa/area-administrativo"> Painel de Controle</a></li>
            <li><a href="/admin/promocoes">Promoções</a></li>
            <li class="active"><a href="/admin/promocoes/cadastra">Cadastrar</a></li>
        </ol>
    </section>

    <!-- Main content -->
<section class="content">
    <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Nova Promoção</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/admin/promocoes/cadastra" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                      <div class="form-row">
                        <div class="col-md-4">
                            <label for="nome_promocao">Promoção</label>
                            <input type="text" class="form-control" id="nome_promocao" name="nome_promocao" placeholder="Promoção" autofocus required>
                        </div>
                      </div>
                          <div class="form-row">
                            <div class="col-md-2">
                                <label for="dtinicio">Data de Início</label>
                                <input type="date" class="form-control" id="dtinicio" name="dtinicio" required>
                            </div>
                              <div class="col-md-2">
                                  <label for="dtfinal">Data de Fim</label>
                                  <input type="date" class="form-control" id="dtfinal" name="dtfinal" step="0.01" required>
                              </div>
                             <div class="col-md-4">
                                 <label for="url_promocao">Url da Promoção</label>
                                 <input type="text" class="form-control" id="url_promocao" name="url_promocao" placeholder="url-exemplo" required>
                             </div>
                              <div class="col-md-8">
                                  <label for="descricao">Descrição da</label>
                                  <textarea name="descricao" class="form-control" id="descricao" placeholder="Digite aqui..." required></textarea>
                                  
                              </div>
                            <div class="col-md-4">
                                <label for="foto_promocao">Imagem da Promoção</label>
                                <input type="file" class="btn btn-default" id="foto_promocao" name="foto_promocao" required>
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
                              <a href="/admin/promocoes" class="btn btn-primary btn-md">Promoções</a>
                          </div>
                      </div>
                      </div>
                </form>
            </div>
        <?php if( $promocaoErro != '' ){ ?>

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo htmlspecialchars( $promocaoErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>

        </div>
        <?php } ?>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


