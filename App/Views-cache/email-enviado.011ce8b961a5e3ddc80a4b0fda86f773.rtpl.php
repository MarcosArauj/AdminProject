<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
<div class="col-md-3"></div>
<div class="product-big-title-area">
        <div class="row">
            <div class="col-md-6">
                <div class="product-bit-title" id="titulo_home">
                    <h1>
                        <a href="/">
                            <b><?php echo getNomeEmpresaCompleto(); ?></b>
                        </a>
                    </h1>
                    <h2>Esqueceu a Senha?</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">E-mail enviado!</h4>
            <p>Verifique seu e-mail e siga as instruções para recuperar a sua senha. Verifique também a caixa de Span.</p><br>
            <a  href="/">Voltar ao Ínicio</a>
            <div class="pull-right">
                <a class="btn btn-social-icon btn-microsoft" href="https://outlook.live.com/owa/" target="_blank">
                    <span class="fa fa-windows"></span>
                </a>
                <a class="btn btn-social-icon btn-google" href="https://accounts.google.com/signin/v2/identifier?continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&service=mail&sacu=1&rip=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin" target="_blank">
                    <span class="fa fa-google"></span>
                </a>
                <a class="btn btn-social-icon btn-yahoo" href="https://login.yahoo.com/" target="_blank">
                    <span class="fa fa-yahoo"></span>
                </a>
            </div>

            <br>
            <?php if( $erro != '' ){ ?>
            <p class="login-box-msg">
                <strong class="erro">
                    <?php echo htmlspecialchars( $erro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </strong>
            </p>
            <?php } ?>
        </div>
    </div>
<div class="col-md-3"></div>
</div>