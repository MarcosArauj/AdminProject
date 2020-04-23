<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="/admin"><strong><?php echo getNomeEmpresa(); ?></strong></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/perfil"><?php echo htmlspecialchars( $proprietario["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
            <li class="active"><a href="/proprietario/atualiza">Editar Dados</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <?php require $this->checkTemplate("perfil_menu");?>
            </div>
            <div class="col-md-9">


                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Perfil</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form  role="form" action="/proprietario/atualiza" name="FormCadastro" method="post">
                        <div class="box-body">
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for="primeiro_nome">Nome</label>
                                    <input type="text" class="form-control" id="primeiro_nome" name="primeiro_nome" value="<?php echo htmlspecialchars( $proprietario["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" >
                                </div>
                                <div class="col-md-4">
                                    <label for="sobrenome">Sobrenome</label>
                                    <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo htmlspecialchars( $proprietario["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                </div>
                                 <div class="col-md-5">
                                <div id="email">
                                    <label for="email"><strong style="color:red">*</strong>Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">@</span>
                                        <input type="email" class="form-control" name="email"  value="<?php echo htmlspecialchars( $proprietario["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" oninput="validarCampoEmail()" required>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for="rg">RG</label>
                                    <input type="text" class="form-control" name="rg" id="rg" value="<?php echo htmlspecialchars( $proprietario["rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control phone-ddd-mask" name="telefone" id="telefone" value="<?php echo htmlspecialchars( $proprietario["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="celular"><strong style="color:red">*</strong>Celular</label>
                                    <input type="text" class="form-control cel-sp-mask" name="celular" id="celular" value="<?php echo htmlspecialchars( $proprietario["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  required>
                                </div>
                                <div class="col-md-3">
                                    <label for="cep"><strong style="color:red">*</strong>CEP</label>
                                    <input type="text" class="form-control cep-mask" name="cep" id="cep" value="<?php echo htmlspecialchars( $proprietario["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="endereco"><strong style="color:red">*</strong>Rua</label>
                                    <input type="text" class="form-control" name="rua" id="endereco" value="<?php echo htmlspecialchars( $proprietario["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-2">
                                    <label for="numero"><strong style="color:red">*</strong>Número</label>
                                    <input type="text" class="form-control" name="numero" id="numero"  value="<?php echo htmlspecialchars( $proprietario["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="bairro"><strong style="color:red">*</strong>Bairro</label>
                                    <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo htmlspecialchars( $proprietario["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="cidade"><strong style="color:red">*</strong>Cidade</label>
                                    <input type="text" class="form-control" name="cidade" id="cidade"  value="<?php echo htmlspecialchars( $proprietario["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="estado"><strong style="color:red">*</strong>Estado</label>
                                    <input type="text" class="form-control" name="estado" id="estado" value="<?php echo htmlspecialchars( $proprietario["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="pais"><strong style="color:red">*</strong>País</label>
                                    <input type="text" class="form-control" name="pais" id="pais" value="<?php echo htmlspecialchars( $proprietario["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                                </div>
                            </div>


                        </div>
                        <div class="box-footer">
                            <div class="col-md-12">
                                <input class="btn btn-primary btn-md" type="submit" value="Atualizar">
                                <a href="/perfil" class="btn btn-primary btn-md">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if( $perfilErro != '' ){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $perfilErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


