<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Fornecedores
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/admin/fornecedores">Fornecedores</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="form-row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <a href="/admin/fornecedores/buscar" class="btn btn-success">Cadastrar Fornecedores</a>
                        <div class="box-tools">
                            <form action="/admin/fornecedores">
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
                        <?php if( $fornecedores ){ ?>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Fornecedores</th>
                                <th>CNPJ</th>
                                <th>Telefone</th>
                                <th style="width: 210px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter1=-1;  if( isset($fornecedores) && ( is_array($fornecedores) || $fornecedores instanceof Traversable ) && sizeof($fornecedores) ) foreach( $fornecedores as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $value1["id_fornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["nome_fantasia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo formataCnpj($value1["cnpj"]); ?></td>
                                <td><?php echo htmlspecialchars( $value1["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>
                                    <a href="/admin/fornecedores/<?php echo htmlspecialchars( $value1["id_fornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/detalha" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Detalhar</a>
                                    <a href="/admin/fornecedores/<?php echo htmlspecialchars( $value1["id_fornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/atualiza" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                    <a href="/admin/fornecedores/<?php echo htmlspecialchars( $value1["id_fornecedor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/exclui" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
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
                <?php if( $fornecedorSucesso != '' ){ ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $fornecedorSucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
                <?php if( $fornecedorErro != '' ){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo htmlspecialchars( $fornecedorErro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>
                <?php } ?>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->