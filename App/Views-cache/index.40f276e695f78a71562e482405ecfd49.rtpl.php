<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="/admin"><strong><?php echo getNomeEmpresa(); ?></strong></a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/perfil"><?php echo htmlspecialchars( $usuario["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <?php require $this->checkTemplate("perfil_menu");?>
            </div>
            <div class="col-md-9">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Perfil do Usu&aacute;rio</h2>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <h4><strong>Dados Pessoais</strong></h4>
                                <label>Nome: </label>
                                <span><?php echo htmlspecialchars( $usuario["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $usuario["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                            <br>
                                <label>Sexo:  </label>
                                <span><?php echo htmlspecialchars( $usuario["sexo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Data de Nascimento:  </label>
                                <span><?php echo formatData($usuario["data_nascimento"]); ?></span>
                                <br>
                                <label>Naturalidade: </label>
                                <span><?php echo htmlspecialchars( $usuario["naturalidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $usuario["uf_nascimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                            <h4><strong>Documentos</strong></h4>
                                <label>RG: </label>
                                <span><?php echo htmlspecialchars( $usuario["rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>CPF: </label>
                                <spna><?php echo formataCpf($usuario["cpf"]); ?></spna>
                                <br>
                            <h4><strong>Contato</strong></h4>
                                <label>Telefone: </label>
                                <span><?php echo htmlspecialchars( $usuario["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Celular: </label>
                                <span><?php echo htmlspecialchars( $usuario["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Email: </label>
                                <span><?php echo htmlspecialchars( $usuario["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                        </div>
                        <div class="col-md-4">
                            <h4><strong>Endere&ccedil;o completo</strong></h4>
                                <label>CEP: </label>
                                <span><?php echo htmlspecialchars( $usuario["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>End: </label>
                                <span><?php echo htmlspecialchars( $usuario["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Número: </label>
                                <span><?php echo htmlspecialchars( $usuario["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Bairro: </label>
                                <span><?php echo htmlspecialchars( $usuario["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Cidade: </label>
                                <span><?php echo htmlspecialchars( $usuario["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Estado: </label>
                                <span><?php echo htmlspecialchars( $usuario["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Pa&iacute;s: </label>
                                <span><?php echo htmlspecialchars( $usuario["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                            </div>
                            <div class="col-md-4">
                            <?php if( $usuario["tipo_usuario"] != 1 ){ ?>
                            <h4><strong>Contratuais</strong></h4>
                                <label>Cargo: </label>
                                <label>CTPS: </label>
                                <span><?php echo htmlspecialchars( $usuario["numero_ctps"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>S&eacute;rie: </label>
                                <span><?php echo htmlspecialchars( $usuario["serie_ctps"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Estado Expedi&ccedil;&atilde;o: </label>
                                <span><?php echo htmlspecialchars( $usuario["estado_ctps"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Data Expedi&ccedil;&atilde;o: </label>
                                <span><?php echo formatData($usuario["data_ctps"]); ?></span>
                                <br>
                                <label>PIS: </label>
                                <span><?php echo htmlspecialchars( $usuario["pis"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Cargo: </label>
                                <span><?php echo htmlspecialchars( $usuario["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                <br>
                                <label>Admiss&atilde;o: </label>
                                <span><?php echo formatData($usuario["dtadmissao"]); ?></span>
                                <br>
                                <?php if( $usuario["acesso"] == 1 ){ ?>
                                  <label>Com Acesso Administrativo </label>
                                <?php }else{ ?>
                                   <label>Sem Acesso Administrativo </label>
                                <?php } ?>
                            <?php } ?>
                        </div>
                </div>
            </div>
                <?php if( $perfilMsg != '' ){ ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $perfilMsg, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
        </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


