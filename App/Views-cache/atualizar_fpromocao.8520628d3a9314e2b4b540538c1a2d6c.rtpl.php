<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro da Promoção
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/empresa/area-administrativo"> Painel de Controle</a></li>
            <li><a href="/admin/promocoes">Promoções</a></li>
            <li class="active"><a href="/admin/promocoes/<?php echo htmlspecialchars( $promocao["id_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha">Detalhar </a></li>
            <li class="active"><a href="/admin/promocoes/<?php echo htmlspecialchars( $promocao["id_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/fotoPromocao">Imagem da Promoção</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Nova Imamgem</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form  name="FormAlteraImgProduto" role="form" action="/admin/promocoes/<?php echo htmlspecialchars( $promocao["id_promocao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/fotoPromocao" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                   <th>Imagem</th>
                                    <th style="width: 300px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="file" class="btn btn-primary" name="foto_promocao" required onchange="carregarImagem(event)">
                                    </td>

                                    <td class="botoescadastro">
                                        <input class="btn btn-primary btn-md" type="submit" value="Atualizar">
                                        <a href="/admin/promocoes" class="btn btn-primary btn-md">Voltar</a>
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
            <?php if( $promocaoFotoErro != '' ){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo htmlspecialchars( $promocaoFotoErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
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
