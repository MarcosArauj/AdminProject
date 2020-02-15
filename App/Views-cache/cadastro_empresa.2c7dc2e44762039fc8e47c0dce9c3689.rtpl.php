<?php if(!class_exists('Rain\Tpl')){exit;}?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cadastro da Empresa no Sistema
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/admin/empresa/cadastra">Cadastrar</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!--Mensagem de Erro-->
        <?php if( $empresaErro != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo htmlspecialchars( $empresaErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>

        <div class="box box-success">
            <!-- /.box-header -->
            <!-- form start -->
            <form  role="form" action="/admin/empresa/cadastra" name="FormCadastro" method="post">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h2 class="box-title">Dados da Empresa</h2>
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <label class="control-label" for="razao_social"><strong class="obrigatorio">*</strong>Raz&atilde;o Social </label>
                                    <input type="text" class="form-control" id="razao_social" name="razao_social"  placeholder="Razão Social" autofocus required>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label" for="nome_fantasia"><strong class="obrigatorio">*</strong>Nome Fantasia </label>
                                    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"  placeholder="Nome Fantasia" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="nome_curto"><strong class="obrigatorio">*</strong>Nome Redusido</label>
                                    <input type="text" class="form-control" id="nome_curto" name="nome_curto" maxlength="20" placeholder="Nome Redusido"  required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="cnpj"><strong class="obrigatorio">*</strong>CNPJ</label>
                                    <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="EX: 77.718.404/0001-40"  onkeypress="formatar('##.###.###/####-##',this)"  minlength="18"  required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="inscricao_municipal"><strong class="obrigatorio">*</strong>Inscri&ccedil;&atilde;o Municipal</label>
                                    <input type="text" class="form-control" id="inscricao_municipal" name="inscricao_municipal" maxlength="20" placeholder="Inscrição Municipal"  required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="inscricao_estadual"><strong class="obrigatorio">*</strong>Inscri&ccedil;&atilde;o Estadual</label>
                                    <input type="text" class="form-control" id="inscricao_estadual" name="inscricao_estadual" maxlength="20" placeholder="Inscrição Estadual"  required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="url_empresa"><strong class="obrigatorio">*</strong>Url da Empresa</label>
                                    <input type="text" class="form-control" id="url_empresa" name="url_empresa" maxlength="20" placeholder="nome-empresa"  required>
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
                                <div class="col-md-8">
                                <div id="email">
                                    <label class="control-label" for="email"><strong class="obrigatorio">*</strong>Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">@</span>
                                        <input type="email" class="form-control" name="email"  placeholder="E-mail (exemplo@email.com)" oninput="ValidarCampoEmail()"required>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label" for="senha"><strong class="obrigatorio">*</strong>Senha do Email</label>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Password" class="form-control" required>
                                        <button type="button" id="mostrar_senha" name="mostrar_senha" class="fa fa-eye-slash" aria-hidden="true"></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="telefone"><strong class="obrigatorio">*</strong>Telefone</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" class="form-control phone-ddd-mask" name="telefone" id="telefone" placeholder="Ex.: (00) 0000-0000" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="celular"><strong class="obrigatorio">*</strong>Celular</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" class="form-control cel-sp-mask" name="celular" id="celular" placeholder="Ex.: (00) 00000-0000" required>
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
                                    <input type="text" class="form-control cep-mask" name="cep" id="cep" placeholder="Ex: 58000-100"  required>
                                </div>
                                <div class="col-md-5">
                                    <label class="control-label" for="endereco"><strong class="obrigatorio">*</strong>Endereço</label>
                                    <input type="text" class="form-control" name="rua" id="endereco" placeholder="Ex.: Rua " required>
                                </div>

                                <div class="col-md-3">
                                    <label class="control-label" for="numero"><strong class="obrigatorio">*</strong>Número</label>
                                    <input type="text" class="form-control" name="numero" id="numero"  placeholder="Nº" maxlength="10" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="bairro"><strong class="obrigatorio">*</strong>Bairro</label>
                                    <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="cidade"><strong class="obrigatorio">*</strong>Cidade</label>
                                    <input type="text" class="form-control" name="cidade" id="cidade"  placeholder="Cidade" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label" for="estado"><strong class="obrigatorio">*</strong>Estado</label>
                                    <input type="text" class="form-control" name="estado" id="estado" placeholder="UF" required>
                                </div>
                                <div class="col-md-8">
                                    <label class="control-label" for="pais"><strong class="obrigatorio">*</strong>País</label>
                                    <input type="text" class="form-control" name="pais" id="pais" placeholder="Páis" required>
                                </div>
                                <input type="hidden" name="responsavel_cadastro" value="<?php echo getNomeUsuario(); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <input class="btn btn-primary btn-md" type="submit" value="Finalizar Cadastro">
                        <button class="btn btn-primary btn-md" type="reset">Limpar</button>
                        <a href="/admin" class="btn btn-primary btn-md">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

