<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dados da Empresa
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/empresa/<?php echo htmlspecialchars( $empresa["url_empresa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalaha"><?php echo htmlspecialchars( $empresa["nome_curto"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!--Mensagem de Sucesso-->
        <?php if( $empresaSucesso != '' ){ ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo htmlspecialchars( $empresaSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </div>
        <?php } ?>
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
                                    <span><?php echo htmlspecialchars( $empresa["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Razão Social:  </label>
                                    <span><?php echo htmlspecialchars( $empresa["razao_social"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>CNPJ:  </label>
                                    <span><?php echo htmlspecialchars( $empresa["cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Inscrição Municipal: </label>
                                    <span><?php echo htmlspecialchars( $empresa["inscricao_municipal"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Inscrição Estadual: </label>
                                    <span><?php echo htmlspecialchars( $empresa["inscricao_estadual"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
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
                                        <span><?php echo htmlspecialchars( $empresa["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                        <br>
                                        <label>Email: </label>
                                        <span><?php echo htmlspecialchars( $empresa["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Celular: </label>
                                        <span><?php echo htmlspecialchars( $empresa["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
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
                                    <span><?php echo htmlspecialchars( $empresa["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>End: </label>
                                    <span><?php echo htmlspecialchars( $empresa["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Número: </label>
                                    <span><?php echo htmlspecialchars( $empresa["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    <label>Bairro: </label>
                                    <span><?php echo htmlspecialchars( $empresa["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Cidade: </label>
                                    <span><?php echo htmlspecialchars( $empresa["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Estado: </label>
                                    <span><?php echo htmlspecialchars( $empresa["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Pa&iacute;s: </label>
                                    <span><?php echo htmlspecialchars( $empresa["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-right">
                            <a href="/admin/empresa/atualiza/<?php echo htmlspecialchars( $empresa["id_empresa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-md">Editar</a>
                            <a href="/admin" class="btn btn-primary btn-md">Voltar</a>
                            </div>
                        </div>

                </div>

    </section>
</div>
