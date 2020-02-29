<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro de Promoção
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/empresa/area-administrativo"> Painel de Controle</a></li>
            <li><a href="/admin/promocoes">Promoções</a></li>
            <li class="active"><a href="/admin/promocoes/<?php echo htmlspecialchars( $promocao["id_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza">Editar Promação</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Promoção</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/admin/promocoes/<?php echo htmlspecialchars( $promocao["id_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" method="post">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-row">
                                   <div class="col-md-12">
                                        <label for="nome_promocao">Promoção</label>
                                        <input type="text" class="form-control" id="nome_promocao" name="nome_promocao" placeholder="Promoção" value="<?php echo htmlspecialchars( $promocao["nome_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                   </div>
                                    <div class="col-md-6">
                                        <label for="dtinicio">Data de Início</label>
                                        <input type="date" class="form-control" id="dtinicio" value="<?php echo htmlspecialchars( $promocao["dtinicio"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dtfinal">Data de Fim</label>
                                        <input type="date" class="form-control" id="dtfinal" value="<?php echo htmlspecialchars( $promocao["dtfinal"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="descricao">Descrição da Promoção</label>
                                    <textarea name="descricao" class="form-control" id="descricao" value=""  rows="5" required><?php echo htmlspecialchars( $promocao["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                                    <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="box-footer">
                        <div class="form-row">
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i>Atualizar</button>
                                <a href="/admin/promocoes/<?php echo htmlspecialchars( $promocao["url_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha" class="btn btn-primary"><i class="fa fa-edit"></i> Detalhar</a>
                                <a href="/admin/promocoes" class="btn btn-primary btn-md">Voltar</a>
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

