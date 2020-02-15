<?php if(!class_exists('Rain\Tpl')){exit;}?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro de Categoria 
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/categorias">Categorias</a></li>
            <li class="active"><a href="/admin/categorias/cadastrar">Cadastrar</a></li>
        </ol>
    </section>

    <!-- Main content -->
<section class="content">
    <div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
                    <h3 class="box-title">Nova Categoria</h3>
                </div>
                <!-- form start -->
                <form name="FormCategoria" role="form" action="/admin/categorias/cadastra" method="post" id="form_cadastro">
                    <div class="box-body">
                        <div class="box-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="nome_categoria" id="nome_categoria"></label>
                                    <input type="text" class="form-control"  name="nome_categoria" placeholder="Categoria de Poduto" autofocus required>
                                    <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="box-footer">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input class="btn btn-primary"  id="salvar" type="submit" value="Finalizar Cadastro">
                                    <button class="btn btn-primary" type="reset">Limpar</button>
                                    <a href="/admin/produtos/cadastra" class="btn btn-primary btn-md">Novo Produto</a>
                                    <a href="/admin/categorias" class="btn btn-primary btn-md">Categorias</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php if( $categoriaSucesso != '' ){ ?>

            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo htmlspecialchars( $categoriaSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>

            </div>
            <?php } ?>

            <?php if( $categoriaErro != '' ){ ?>

            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo htmlspecialchars( $categoriaErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>

            </div>
            <?php } ?>

    </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--<script>-->
<!--    $('#form_cadastro').submit(function (e) {-->
<!--        e.preventDefault();-->
<!--        // alert("Teste");-->
<!--        var formulario = $(this);-->
<!--        // alert(formulario.serialize());-->
<!--        var retorno = inserirFormulario(formulario)-->
<!--    });-->

<!--    function inserirFormulario(dados) {-->
<!--        $.ajax({-->
<!--            type:"POST",data:dados.serialize(),-->
<!--            url:"/admin/categorias/cadastra",-->
<!--            async:false-->
<!--        }).then(falha);-->


<!--        function falha() {-->
<!--            document.getElementById("nome_categoria").setAttribute("class", "has-error col-md-6");-->
<!--            $('#erroCadastro').html('Categoria já cadastrado!');-->

<!--        }-->
<!--    }-->

<!--</script>-->

