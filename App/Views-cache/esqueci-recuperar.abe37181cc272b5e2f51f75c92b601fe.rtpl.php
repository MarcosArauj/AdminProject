<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div id="titulo_home">
            <h2 ><b>Esqueceu a Senha?</b></h2>
        </div>
        <div class="box box-primary">
            <form name="FormAlteraSenha" action="/recupera-senha/esqueci/recupera" method="post">
                <div class="box-body">
                        <input type="hidden" name="code" value="<?php echo htmlspecialchars( $code, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <h4>Olá <?php echo htmlspecialchars( $name, ENT_COMPAT, 'UTF-8', FALSE ); ?>, digite uma nova senha:</h4>
                        <div class="form-row">
                            <div id="nova_senha">
                                <label class="control-label" for="nova_senha">Nova Senha*</label>
                                <input type="password" class="form-control"  name="nova_senha" id="novasenha" maxlength="20" oninput="ValidarCampoDeSenha()" required>
                            </div>
                            <div id="confirma_senha">
                                <label class="control-label" for="confirma_senha">Confirme a Nova Senha*</label>
                                <input type="password" class="form-control" name="confirma_senha" id="confirmasenha" maxlength="20" oninput="ValidarCampoDeSenha()" required>
                            </div>
                        </div>
                   </div>
                <div class="box-footer">
                    <input type="button" id="mostrar_senha_alterar" class="btn btn-default btn-md" value="Mostrar Senhas" class="button" />
                    <div class="pull-right">
                        <button type="submit" class="btn btn-md btn-success"><span class="glyphicon glyphicon-lock">
                          <strong> Enviar</strong></span></button>
                    </div>
                </div>
            </form>
            <div class="box-footer">
                <?php if( $erro != '' ){ ?>
                <p class="login-box-msg">
                    <strong class="erro">
                    <?php echo htmlspecialchars( $erro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </strong>
                </p>
                <?php } ?>
            </div>

        </div>
    </div>
    <div class="col-md-4"></div>
</div>