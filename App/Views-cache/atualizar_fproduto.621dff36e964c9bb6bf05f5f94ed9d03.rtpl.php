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
            <li><a href="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalhar"><?php echo htmlspecialchars( $produto["nome_produto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
            <li class="active"><a href="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/fotoProduto">Imagem do Produto</a></li>
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
                <form  name="FormAlteraImgProduto" role="form" action="/admin/produtos/<?php echo htmlspecialchars( $produto["id_pcf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/fotoProduto" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                   <th>Imagem</th>
                                    <th style="width: 250px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="file" class="btn btn-primary" name="foto_produto" required onchange="carregarImagem(event)">
                                    </td>

                                    <td class="botoescadastro">
                                        <button class="btn btn-primary btn-md" type="submit">Atualizar</button>
                                        <a href="/admin/produtos" class="btn btn-primary btn-md">Voltar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <img width="200px" id="nova_imagem">
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
            <?php if( $produtoFotoErro != '' ){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo htmlspecialchars( $produtoFotoErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    var carregarImagem = function(){
        var reader = new FileReader();
        reader.onload = function(){

            var output = document.getElementById('nova_imagem');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>