<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="container">

    <div class="login-box">
        <!-- /.login-logo -->
        <h1 id="titulo_home">
            <a href="/">
                <b><?php echo getNomeEmpresaCompleto(); ?></b>
            </a>
        </h1>

        <div class="login-box-body">

            <p class="login-box-msg"><strong>Entre em sua Conta</strong></p>

            <form action="/" class="log" method="post" id="login-form">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="exemplo@exemplo.com (Usuário: exemplo)" name="login" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
               <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Password" class="form-control" required>
                   <button type="button" id="mostrar_senha" name="mostrar_senha" class="fa fa-eye-slash" aria-hidden="true"></button>
              </div>
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
        <!-- /.login-box-body -->
        <?php if( $erro != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p style="text-align: center"><strong><?php echo htmlspecialchars( $erro, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>
    </div>
    <!-- /.login-box -->

</div>

