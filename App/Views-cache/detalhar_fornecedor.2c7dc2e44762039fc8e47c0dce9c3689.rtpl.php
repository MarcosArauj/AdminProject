<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dados da Fornecedor
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/fornecedores/<?php echo htmlspecialchars( $fornecedor["id_fornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha"><?php echo htmlspecialchars( $fornecedor["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <div class="box box-success">

                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Dados Cadastrais</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12">
                                    <label>Nome Fantasia: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Razão Social:  </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["razao_social"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>CNPJ:  </label>
                                    <span><?php echo formataCnpj($fornecedor["cnpj"]); ?></span>
                                    <br>
                                    <label>Inscrição Municipal: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["inscricao_municipal"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Inscrição Estadual: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["inscricao_estadual"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Contatos</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <label>Telefone: </label>
                                        <span><?php echo htmlspecialchars( $fornecedor["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                        <br>
                                        <label>Email: </label>
                                        <span><?php echo htmlspecialchars( $fornecedor["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Celular: </label>
                                        <span><?php echo htmlspecialchars( $fornecedor["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Endere&ccedil;o</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                    <label>CEP: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>End: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Número: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    <label>Bairro: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Cidade: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Estado: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Pa&iacute;s: </label>
                                    <span><?php echo htmlspecialchars( $fornecedor["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-right">
                            <a href="/admin/fornecedores/<?php echo htmlspecialchars( $fornecedor["id_fornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-md">Editar</a>
                            <a href="/admin/fornecedores" class="btn btn-primary btn-md">Fornecedores</a>
                            </div>
                        </div>

                </div>

    </section>
</div>
