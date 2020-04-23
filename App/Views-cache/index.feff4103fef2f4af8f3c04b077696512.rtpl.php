<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="container">

    <div class="login-box">
        <!-- /.home-logo -->
        <h1 id="titulo_home">
            <a href="/">
                <b><?php echo getNomeEmpresaCompleto(); ?></b>
            </a>
        </h1>

        <div class="login-box-body">

            <p class="login-box-msg"><strong>Entre em sua Conta</strong></p>

            <form action="/" class="log" method="post" id="login-form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="exemplo@exemplo.com (Usuário: exemplo)" name="login" required autofocus>
                    <span class="input-group-addon" >
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                </div>
                <br>
                <div class="input-group">
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Password" required>
                    <span class="input-group-addon" >
                        <span id="mostrar_senha" name="mostrar_senha" class="fa fa-eye-slash" aria-hidden="true"></span>
                    </span>
                </div>
                <br>
              <div align="center">
                  <button type="submit" class="btn btn-block btn-primary" id="acessar"><span class="glyphicon glyphicon-lock">
                      <strong> Entrar</strong></span></button>
                 </div>

            </form>

            <div class="social-auth-links text-center">
                <p>- OU -</p>
            </div>

            <a class="pull-right" href="/recupera-senha/esqueci">Esqueci minha senha</a><br>
        </div>
        <br>
        <!-- /.home-box-body -->
        <?php if( $erro != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p style="text-align: center"><strong><?php echo htmlspecialchars( $erro, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>
    </div>
    <!-- /.home-box -->

</div>

