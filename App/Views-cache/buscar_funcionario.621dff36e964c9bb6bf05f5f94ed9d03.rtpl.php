<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="titulo_home">
            Buscar de Pessoa

        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/admin/funcionarios/buscar">Buscar</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="form-row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="/admin/funcionarios/buscar">
                    <div class="input-group input-group">
                        <input type="text" name="busca" class="form-control cpf-mask" placeholder="Digite CPF(apenas números)" value="<?php echo htmlspecialchars( $busca, ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <br>
                <?php if( $funcionarioErro != '' ){ ?>
                <a href="/admin/funcionarios/cadastra" class="btn btn-success pull-right"><?php echo htmlspecialchars( $funcionarioErro, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                <?php } ?>
                <?php if( $funcionarioErroAtiva != '' ){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $funcionarioErroAtiva, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-12">
                <?php if( $funcionarios ){ ?>
                <div class="box box-primary">

                    <div class="box-body no-padding">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px"><strong>#</strong></th>
                                <th>Nome</th>
                                <th>Data Nascimento</th>
                                <th>Naturalidade</th>
                                <th>CPF</th>
                                <th>Celular</th>
                                <th style="width: 240px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter1=-1;  if( isset($funcionarios) && ( is_array($funcionarios) || $funcionarios instanceof Traversable ) && sizeof($funcionarios) ) foreach( $funcionarios as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo formatData($value1["data_nascimento"]); ?></td>
                                <td><?php echo htmlspecialchars( $value1["naturalidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo formataCpf($value1["cpf"]); ?></td>
                                <td><?php echo htmlspecialchars( $value1["celular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>
                                    <?php if( $value1["status_funcionario"] == 'ativo' ){ ?>
                                    <a href="/admin/funcionarios/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Detalhar</a>
                                    <a href="/admin/funcionarios/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                    <a href="/admin/funcionarios/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/exclui" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                                    <?php }else{ ?>
                                    <span class="erro"><b>Funcion&aacute;rio Desligado</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a href="/admin/funcionarios/buscar/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/ativa" onclick="return confirm('Deseja realmente ativar este registro?')" class="btn btn-success btn-xs pull-right"><i class="fa fa-sort-asc"></i> Ativar</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <?php $counter1=-1;  if( isset($paginas) && ( is_array($paginas) || $paginas instanceof Traversable ) && sizeof($paginas) ) foreach( $paginas as $key1 => $value1 ){ $counter1++; ?>
                            <li><a href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->