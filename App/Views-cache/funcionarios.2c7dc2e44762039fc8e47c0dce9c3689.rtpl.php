<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Funcionários

        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/admin/funcionarios">Funcionários</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="form-row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <a href="/admin/funcionarios/buscar" class="btn btn-success">Cadastrar Novo Funcionario</a>
                        <div class="box-tools">
                            <form action="/admin/funcionarios">
                                <div class="input-group input-group" style="width: 200px;">
                                    <input type="text" name="busca" class="form-control pull-right" placeholder="Buscar" value="<?php echo htmlspecialchars( $busca, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box-body no-padding">
                        <?php if( $funcionarios ){ ?>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px"><strong>#</strong></th>
                                <th>Funcionarios</th>
                                <th>Cargo</th>
                                <th>Acesso de Administrador</th>
                                <th  style="width: 260px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter1=-1;  if( isset($funcionarios) && ( is_array($funcionarios) || $funcionarios instanceof Traversable ) && sizeof($funcionarios) ) foreach( $funcionarios as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $value1["id_funcionario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["primeiro_nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <?php if( $value1["acesso"] == 1 ){ ?>
                                <td>Sim</td>
                                <?php }else{ ?>
                                <td>Não</td>
                                <?php } ?>
                                <td>
<!--                                    <?php if( $value1["status_funcionario"] == 'ativo' ){ ?>-->
                                    <a href="/admin/funcionarios/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Detalhar</a>
                                    <a href="/admin/funcionarios/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                    <a href="/admin/funcionarios/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/exclui" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
<!--                                    <?php }else{ ?>-->
<!--                                    <span class="erro"><b>Desligado</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>-->
<!--                                    <a href="/admin/funcionarios/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/apaga" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>-->
<!--                                    <a href="/admin/funcionarios/buscar/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/ativa" onclick="return confirm('Deseja realmente ativar este registro?')" class="btn btn-success btn-xs"><i class="fa fa-sort-asc"></i> Ativar</a>-->
<!--                                    <?php } ?>-->
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <?php $counter1=-1;  if( isset($paginas) && ( is_array($paginas) || $paginas instanceof Traversable ) && sizeof($paginas) ) foreach( $paginas as $key1 => $value1 ){ $counter1++; ?>
                            <li><a href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <?php if( $funcionarioSucesso != '' ){ ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $funcionarioSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
                <?php if( $funcionarioErro != '' ){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $funcionarioErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->