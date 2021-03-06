<?php if(!class_exists('Rain\Tpl')){exit;}?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Editar Cadastro do Fornecedor
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/admin/fornecedores/<?php echo htmlspecialchars( $fornecedor["id_fornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza">Atualiza</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!--Mensagem de Erro-->
        <?php if( $fornecedorErro != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo htmlspecialchars( $fornecedorErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>
        <!--Mensagem de Sucesso-->
        <?php if( $fornecedorSucesso != '' ){ ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo htmlspecialchars( $fornecedorSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>
        <div class="box box-success">
            <!-- /.box-header -->
            <!-- form start -->
            <form  role="form" action="/admin/fornecedores/<?php echo htmlspecialchars( $fornecedor["id_fornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" name="FormCadastro" method="post">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h2 class="box-title">Dados da Empresa</h2>
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <label class="control-label" for="razao_social"><strong class="obrigatorio">*</strong>Raz&atilde;o Social </label>
                                    <input type="text" class="form-control" id="razao_social" name="razao_social"  value="<?php echo htmlspecialchars( $fornecedor["razao_social"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" autofocus required>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label" for="nome_fantasia"><strong class="obrigatorio">*</strong>Nome Fantasia </label>
                                    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"  value="<?php echo htmlspecialchars( $fornecedor["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="cnpj"><strong class="obrigatorio">*</strong>CNPJ</label>
                                    <input type="text" class="form-control" id="cnpj" name="cnpj"  onkeypress="formatar('##.###.###/####-##',this)"  minlength="18"  value="<?php echo htmlspecialchars( $fornecedor["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="inscricao_municipal"><strong class="obrigatorio">*</strong>Inscri&ccedil;&atilde;o Municipal</label>
                                    <input type="text" class="form-control" id="inscricao_municipal" name="inscricao_municipal" maxlength="20" value="<?php echo htmlspecialchars( $fornecedor["inscricao_municipal"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="inscricao_estadual"><strong class="obrigatorio">*</strong>Inscri&ccedil;&atilde;o Estadual</label>
                                    <input type="text" class="form-control" id="inscricao_estadual" name="inscricao_estadual" maxlength="20" value="<?php echo htmlspecialchars( $fornecedor["inscricao_estadual"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h2 class="box-title">Contatos</h2>
                            </div>
                            <div class="box-body">
                                <div id="email" class="col-md-12">
                                    <label class="control-label" for="email"><strong class="obrigatorio">*</strong>Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">@</span>
                                        <input type="email" class="form-control" name="email"  oninput="ValidarCampoEmail()" value="<?php echo htmlspecialchars( $fornecedor["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="telefone"><strong class="obrigatorio">*</strong>Telefone</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" class="form-control phone-ddd-mask" name="telefone" id="telefone" value="<?php echo htmlspecialchars( $fornecedor["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="celular"><strong class="obrigatorio">*</strong>Celular</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" class="form-control cel-sp-mask" name="celular" id="celular" value="<?php echo htmlspecialchars( $fornecedor["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h2 class="box-title">Endereço</h2>
                            </div>
                            <div class="box-body">
                                <div class="col-md-4">
                                    <label class="control-label" for="cep"><strong class="obrigatorio">*</strong>CEP</label>
                                    <input type="text" class="form-control cep-mask" name="cep" id="cep" value="<?php echo htmlspecialchars( $fornecedor["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="control-label" for="endereco"><strong class="obrigatorio">*</strong>Endereço</label>
                                    <input type="text" class="form-control" name="rua" id="endereco" value="<?php echo htmlspecialchars( $fornecedor["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="control-label" for="numero"><strong class="obrigatorio">*</strong>Número</label>
                                    <input type="text" class="form-control" name="numero" id="numero"  value="<?php echo htmlspecialchars( $fornecedor["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="bairro"><strong class="obrigatorio">*</strong>Bairro</label>
                                    <input type="text" class="form-control" name="estado" id="bairro" value="<?php echo htmlspecialchars( $fornecedor["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="cidade"><strong class="obrigatorio">*</strong>Cidade</label>
                                    <input type="text" class="form-control" name="estado" id="cidade"  value="<?php echo htmlspecialchars( $fornecedor["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label" for="estado"><strong class="obrigatorio">*</strong>Estado</label>
                                    <input type="text" class="form-control" name="estado" id="estado" value="<?php echo htmlspecialchars( $fornecedor["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <div class="col-md-8">
                                    <label class="control-label" for="pais"><strong class="obrigatorio">*</strong>País</label>
                                    <input type="text" class="form-control" name="pais" id="pais" value="<?php echo htmlspecialchars( $fornecedor["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                                </div>
                                <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <input class="btn btn-primary btn-md" type="submit" value="Atualiza">
                        <a href="/admin/fornecedores" class="btn btn-primary btn-md">Fornecedores</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

