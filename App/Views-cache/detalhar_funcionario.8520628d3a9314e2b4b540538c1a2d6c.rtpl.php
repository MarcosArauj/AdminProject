<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detalhes Funcion&aacute;rio
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/funcionarios">Funcion&aacute;rios</a></li>
            <li class="active"><a href="/admin/funcionarios/<?php echo htmlspecialchars( $funcionario["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha"><?php echo htmlspecialchars( $funcionario["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
            <div class="box box-success">

                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Dados Pessoais</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                    <label>Nome : </label>
                                    <span><?php echo htmlspecialchars( $funcionario["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $funcionario["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Data de Nascimento:  </label>
                                    <span><?php echo formatData($funcionario["data_nascimento"]); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    <label>Sexo:  </label>
                                    <span><?php echo htmlspecialchars( $funcionario["sexo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Naturalidade: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["naturalidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $funcionario["uf_nascimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Endere&ccedil;o</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                    <label>CEP: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>End: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Número: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    <label>Bairro: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Cidade: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Estado: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Pa&iacute;s: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Documentos Pessoais</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-5">
                                    <label>RG: </label>
                                    <span><?php echo htmlspecialchars( $funcionario["rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-4">
                                    <label>CPF: </label>
                                    <spna><?php echo formataCpf($funcionario["cpf"]); ?></spna>
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
                                        <span><?php echo htmlspecialchars( $funcionario["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                        <br>
                                        <label>Email: </label>
                                        <span><?php echo htmlspecialchars( $funcionario["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Celular: </label>
                                        <span><?php echo htmlspecialchars( $funcionario["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Acesso</h2>
                                </div>
                                <div class="panel-body">
                                <label>  Acesso de Administrador: </label>
                                    <?php if( $funcionario["acesso"] == 1 ){ ?>
                                    <span>Sim</span>
                                    <?php }else{ ?>
                                    <span>Não</span>
                                    <?php } ?>
                                </div>
                                </div>
                                </div>
                            </div>
                        <div class="box-footer">
                            <a href="/admin/funcionarios/<?php echo htmlspecialchars( $funcionario["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-md">Editar</a>
                            <a href="/admin/funcionarios" class="btn btn-primary btn-md">Voltar</a>
                        </div>

                </div>

    </section>
</div>
