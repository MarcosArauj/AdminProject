<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo getNomeEmpresa(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Icone -->
    <!--Icone-->
    <link rel="shortcut icon" href="/res/imageSite/header/logo_cn.ico" />
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/res/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="/res/stylecn/css/styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/res/adminLte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/res/adminLte/plugins/iCheck/square/blue.css">

<body class="hold-transition login-page">
<div class="container">
    <h1 id="titulo_home">
        <b>Cadastro Propriet&aacute;rio - <?php echo getNomeEmpresa(); ?></b>
    </h1>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Dados do Propriet&aacute;rio</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form  role="form" action="/proprietario/cadastra" name="FormCadastro" method="post">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h2 class="box-title">Dados Pessoais</h2>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <label class="control-label" for="primeiro_nome"><strong class="obrigatorio">*</strong>Primeiro Nome</label>
                                <input type="text" class="form-control" id="primeiro_nome" name="primeiro_nome" maxlength="20" placeholder="Primeiro Nome" autofocus required>

                                <label class="control-label" for="sobrenome"><strong class="obrigatorio">*</strong>Sobrenome</label>
                                <input type="text" class="form-control" id="sobrenome" name="sobrenome" maxlength="20" placeholder="Sobrenome" required>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="sexo"><strong class="obrigatorio">*</strong>Sexo</label>
                                <select class="form-control" name="sexo" id="sexo" required>
                                    <option value="">Selecione</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="data_nascimento"><strong class="obrigatorio">*</strong>Data de Nascimento</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"  placeholder="Ex.: 00/00/0000" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="uf_nascimento"><strong class="obrigatorio">*</strong>Estado Nascimento</label>
                                <select class="form-control" name="uf_nascimento" id="uf_nascimento" required>
                                    <option value="">Selecione</option>
                                    <?php $counter1=-1;  if( isset($estados) && ( is_array($estados) || $estados instanceof Traversable ) && sizeof($estados) ) foreach( $estados as $key1 => $value1 ){ $counter1++; ?>
                                    <option value="<?php echo htmlspecialchars( $value1["uf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["uf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="col-md-8">
                                <label class="control-label" for="naturalidade"><strong class="obrigatorio">*</strong>Naturalidade </label>
                                <input type="text" class="form-control" id="naturalidade" name="naturalidade"  placeholder="Cidade de Nascimento" required>
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h2 class="box-title">Documentos</h2>
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <label class="control-label" for="rg"><strong class="obrigatorio">*</strong>RG</label>
                                <input type="text" class="form-control" name="rg" id="rg" placeholder="RG" required>
                            </div>
                            <div id="cpf" class="col-md-6">
                                <label class="control-label" for="cpf"><strong class="obrigatorio">*</strong>CPF</label>
                                <input type="text" class="form-control cpf-mask" name="cpf"  placeholder="Ex.: 000.000.000-00"  oninput="ValidaCampoCpf()" required>
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
                                    <input type="email" class="form-control" name="email"  placeholder="E-mail (exemplo@email.com)" oninput="ValidarCampoEmail()" required>
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

                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="botoescadastro">
                    <input class="btn btn-primary btn-md" type="submit" value="Finalizar Cadastro">
                    <button class="btn btn-primary btn-md" type="reset">Limpar</button>
                </div>
            </div>
        </form>
    </div>
    <!--Mensagem de Erro-->
    <?php if( $proprietarioErro != '' ){ ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo htmlspecialchars( $proprietarioErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
    </div>
    <?php } ?>
</div>

<!-- REQUIRED JS SCRIPTS -->

<script src="/res/validacao/js/validaForm.js"></script>
<script src="/res/utilitarios/js/jquery.js"></script>
<script src="/res/utilitarios/js/funcoesUteis.js"></script>

<script src="/res/adminLte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="//assets.locaweb.com.br/locastyle/2.0.6/javascripts/locastyle.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/res/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/res/adminLte/dist/js/app.min.js"></script>

</body>
</html>
