<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detalhes Cliente
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/clientes">Clientes</a></li>
            <li class="active"><a href="/admin/funcionarios/<?php echo htmlspecialchars( $cliente["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha"><?php echo htmlspecialchars( $cliente["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
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
                                    <span><?php echo htmlspecialchars( $cliente["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $cliente["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Data de Nascimento:  </label>
                                    <span><?php echo formatData($cliente["data_nascimento"]); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    <label>Sexo:  </label>
                                    <span><?php echo htmlspecialchars( $cliente["sexo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Naturalidade: </label>
                                    <span><?php echo htmlspecialchars( $cliente["naturalidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $cliente["uf_nascimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
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
                                    <span><?php echo htmlspecialchars( $cliente["cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>End: </label>
                                    <span><?php echo htmlspecialchars( $cliente["rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Número: </label>
                                    <span><?php echo htmlspecialchars( $cliente["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    <label>Bairro: </label>
                                    <span><?php echo htmlspecialchars( $cliente["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Cidade: </label>
                                    <span><?php echo htmlspecialchars( $cliente["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Estado: </label>
                                    <span><?php echo htmlspecialchars( $cliente["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    <br>
                                    <label>Pa&iacute;s: </label>
                                    <span><?php echo htmlspecialchars( $cliente["pais"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
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
                                    <span><?php echo htmlspecialchars( $cliente["rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-4">
                                    <label>CPF: </label>
                                    <spna><?php echo formataCpf($cliente["cpf"]); ?></spna>
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
                                        <span><?php echo htmlspecialchars( $cliente["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                        <br>
                                        <label>Email: </label>
                                        <span><?php echo htmlspecialchars( $cliente["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Celular: </label>
                                        <span><?php echo htmlspecialchars( $cliente["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                        <div class="box-footer">
                            <a href="/admin/clientes/<?php echo htmlspecialchars( $cliente["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-md">Editar</a>
                            <a href="/admin/clientes" class="btn btn-primary btn-md">Voltar</a>
                        </div>

                </div>

    </section>
</div>
