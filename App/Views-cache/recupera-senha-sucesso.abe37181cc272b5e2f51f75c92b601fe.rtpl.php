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
        <h4 class="alert-heading">Senha Alterada!!</h4>
        <p>Tente fazer o login com sua nova senha. <span><a href="/">Clique aqui</a> para fazer o login.</span></p>
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