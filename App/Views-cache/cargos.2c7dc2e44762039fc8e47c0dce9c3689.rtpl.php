<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Cargos
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/admin/cargos">Cargos</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="form-row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <a href="/admin/cargos/cadastra" class="btn btn-success">Cadastrar Cargo</a>
                        <div class="box-tools">
                            <form action="/admin/cargos">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <input type="text" name="busca" class="form-control pull-right" placeholder="Buscar" value="<?php echo htmlspecialchars( $busca, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Cargo</th>
                                <th style="width: 140px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter1=-1;  if( isset($cargos) && ( is_array($cargos) || $cargos instanceof Traversable ) && sizeof($cargos) ) foreach( $cargos as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $value1["id_cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>

                                <td>
                                    <a href="/admin/cargos/<?php echo htmlspecialchars( $value1["id_cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                    <a href="/admin/cargos/<?php echo htmlspecialchars( $value1["id_cargo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/exclui" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
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
                </div>
                <?php if( $cargoSucesso != '' ){ ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars( $cargoSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
                <?php if( $cargoErro != '' ){ ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars( $cargoErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->