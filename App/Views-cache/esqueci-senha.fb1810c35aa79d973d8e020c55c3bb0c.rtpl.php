<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="container">
 <div class="col-md-4"></div>
    <div class="col-md-4">
        <div id="titulo_home">
            <h2 ><b>Esqueceu a Senha?</b></h2>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recuperar senha</h3>
            </div>
            <div class="box-body">
                <form action="/recupera-senha/esqueci" method="post">
                    <label for="email">E-mail para recuperação <span class="required">*</span>
                    </label>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div align="center">
                        <button type="submit" class="btn btn-block btn-success"><strong>Enviar&nbsp;&nbsp;&nbsp;</strong>
                            <span class="fa fa-arrow-right"></span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="box-footer">
            <?php if( $erro != '' ){ ?>
            <p class="login-box-msg">
                <strong class="erro">
                    <?php echo htmlspecialchars( $erro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </strong>
            </p>
            <?php } ?>
            <a class="pull-right" href="/">Voltar para Login</a><br>
            </div>

        </div>
  </div>
 <div class="col-md-4"></div>
</div>



