<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | <?php echo getNomeEmpresa(); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--Icone-->
    <link rel="shortcut icon" href="/vendor/project/res/imageSite/header/logo_cn.ico" />
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/vendor/project/res/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="/vendor/project/res/stylecn/css/styles.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/project/res/adminLte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->

    <link rel="stylesheet" href="/vendor/project/res/adminLte/dist/css/skins/skin-green.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <script src="/vendor/project/res/utilitarios/js/jquery.js"></script>
    <script src="/vendor/project/res/validacao/js/mascara.js"></script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b><?php echo getIniciaisEmpresa(); ?></b></span>
            <!-- Nome do Usuario Logado -->
            <span><b style="font-size: 20px"><?php echo getNomeEmpresa(); ?></b></span>

        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="" class="glyphicon glyphicon-log-out" data-toggle="modal" data-target="#ModalSair">&nbsp;<strong>Sair</strong></a>

                    </li>
                </ul>
            </div>

        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <a href="/perfil">
                <div class="user-panel mt-3">
                    <div class="pull-left">
                        <strong><?php echo getIniciaisUsuario(); ?></strong>
                    </div>
                    <div class="info">
                        <!-- Status -->
                        <strong style="font-size: large"><?php echo getNomeUsuario(); ?></strong>
                    </div>
                </div>
            </a>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li><a href="/admin"><i class="fa fa-dashboard"></i><span>Pain&eacute;l de Controle</span></a></li>
                <!-- Optionally, you can add icons to the links -->
                <?php if( checarLogin() ){ ?>
                <li class="treeview">
                    <a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span>Funcion&aacute;rios</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/funcionarios/buscar"><i class="fa fa-angle-right"></i>Cadastrar</a></li>
                        <li><a href="/admin/funcionarios"><i class="fa fa-angle-right"></i>Listar</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="treeview">
                    <a href="#"><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Produtos</span>
                        <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/categorias"><i class="fa fa-angle-right"></i>Categorias</a></li>
                        <li><a href="/admin/fabricantes"><i class="fa fa-angle-right"></i>Fabricantes</a></li>
                        <li><a href="/admin/produtos/cadastra"><i class="fa fa-angle-right"></i>Cadastrar</a></li>
                        <li><a href="/admin/produtos"><i class="fa fa-angle-right"></i>Listar</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span>Fornecedores</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/fornecedores/buscar"><i class="fa fa-angle-right"></i>Cadastrar</a></li>
                        <li><a href="/admin/fornecedores"><i class="fa fa-angle-right"></i>Listar</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> <span>Clientes</span>
                        <span class="pull-right-container">
                             <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/clientes/buscar"><i class="fa fa-angle-right"></i>Cadastrar</a></li>
                        <li><a href="/admin/clientes"><i class="fa fa-angle-right"></i>Listar</a></li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Modal Sair -->
    <div class="modal fade" id="ModalSair" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" id="titulo_home"><b><?php echo getNomeEmpresaCompleto(); ?></b></h3>
                </div>
                <div class="modal-body">
                    <p><b><?php echo getNomeUsuario(); ?>, certeza que deseja sair do Sistema?</b></p>
                </div>
                <div class="modal-footer">
                    <a href="/logout" class="btn btn-danger">&nbsp;<strong>Sair</strong></a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>

        </div>
    </div>
