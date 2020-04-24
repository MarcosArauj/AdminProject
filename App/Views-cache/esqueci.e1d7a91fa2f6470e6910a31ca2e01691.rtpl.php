<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <style>
        * {
        margin:0;
        padding:0;
        font-family: Helvetica, Arial, sans-serif;
        }

        img {
        max-width: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
        }

        #btn-redefine{
        background-color:#41CC00;
        background-image:url(https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7);
        border:1px solid #407429;
        border-radius:4px;
        color:#ffffff;
        display:inline-block;
        font-family:sans-serif;
        font-size:17px;
        font-weight:bold;
        text-shadow: -1px -1px #47A54B;
        line-height:38px;
        text-align:center;
        text-decoration:none;
        width:230px;
        -webkit-text-size-adjust:none;
        mso-hide:all;
        }


        body {
        -webkit-font-smoothing:antialiased;
        -webkit-text-size-adjust:none;
        width: 100%!important;
        height: 100%;
        text-align: center;
        color: #747474;
        background-color: #ffffff;
        }

        h1,h2,h3,h4,h5,h6 {
        font-family: Helvetica, Arial, sans-serif;
        line-height: 1.1;
        }

        h1 small, h2 small, h3 small, h4 small, h5 small, h6 small {
        font-size: 60%;
        line-height: 0;
        text-transform: none;
        }

        h1 {
        font-weight:200;
        font-size: 44px;
        }

        h2 {
        font-weight:200;
        font-size: 32px;
        margin-bottom: 14px;
        }

        h3 {
        font-weight:500;
        font-size: 27px;
        }

        h4 {
        font-weight:500;
        font-size: 23px;
        }

        h5 {
        font-weight:900;
        font-size: 17px;
        }

        h6 {
        font-weight:900;
        font-size: 14px;
        text-transform: uppercase;
        }

        td, div {
        font-family: Helvetica, Arial, sans-serif;
        text-align: center;
        }

        p, ul {
        margin-bottom: 10px;
        font-weight: normal;
        font-size:14px;
        line-height:1.6;
        }

        ul li {
        margin-left:5px;
        list-style-position: inside;
        }

        a {
        color: #747474;
        text-decoration: none;
        }

        a img {
        border: none;
        }

        .head-wrap {
        width: 100%;
        margin: 0 auto;
        background-color: white;
        border-bottom: 1px solid white;
        }

        .head-wrap * {
        margin: 0;
        padding: 0;
        }

        .header {
        height: 42px;
        }

        .header .content {
        padding: 0;
        }

        .header .brand a {
        color: #464646;
        }

        .body-wrap {
        width: 505px;
        margin: 0 auto;
        background-color: #ffffff;
        }

        .soapbox .soapbox-title {
        font-size: 21px;
        color: #464646;
        padding-top: 35px;
        }

        .content .status-container.single .status-padding {
        width: 80px;
        }

        .content .status {
        width: 90%;
        }

        .content .status-container.single .status {
        width: 300px;
        }

        .status {
        border-collapse: collapse;
        margin-left: 15px;
        color: #656565;
        }

        .body .body-padded,
        .body .body-padding {
        padding-top: 34px;
        }

        .body .body-padding {
        width: 41px;
        }

        .body-padded,
        .body-title {
        text-align: left;
        }

        .body .body-title {
        font-weight: bold;
        font-size: 17px;
        color: #464646;
        }

        .body .body-text .body-text-cell {
        text-align: left;
        font-size: 14px;
        line-height: 1.6;
        padding: 9px 0 17px;
        }

        .body .body-text-cell a {
        color: #464646;
        text-decoration: underline;
        }

        .body .body-signature-block .body-signature-cell {
        padding: 25px 0 30px;
        text-align: left;
        }

        .body .body-signature {
        font-family: "Comic Sans MS", Textile, cursive;
        font-weight: bold;
        }

        .footer-wrap {
        width: 100%;
        margin: 0 auto;
        clear: both !important;
        background-color: #e5e5e5;
        border-top: 1px solid #b3b3b3;
        font-size: 12px;
        color: #656565;
        line-height: 30px;
        }

        .footer-wrap .container {
        padding: 14px 0;
        }

        .footer-wrap .container .content {
        padding: 0;
        }

        .footer-wrap .container .footer-lead a {
        font-size: 14px;
        font-weight: bold;
        color: #535353;
        }

        .footer-wrap .container a {
        font-size: 12px;
        color: #656565;
        }

        .container {
        display: block !important;
        max-width: 505px !important;
        clear: both !important;
        }

        .content {
        padding: 0;
        max-width: 505px;
        margin: 0 auto;
        display: block;
        }

        .content table {
        width: 100%;
        }

        table.full-width-gmail-android {
        width: 100% !important;
        }


        @media only screen {

        table[class*="head-wrap"],
        table[class*="body-wrap"],
        table[class*="footer-wrap"] {
        width: 100% !important;
        }

        td[class*="container"] {
        margin: 0 auto !important;
        }

        }

        @media only screen and (max-width: 505px) {

        *[class*="w320"] {
        width: 320px !important;
        }

        table[class="soapbox"] td[class*="soapbox-title"],
        table[class="body"] td[class*="body-padded"] {
        padding-top: 24px;
        }
        }
    </style>
    <title>Recuperar Senha</title>

</head>

<body>

<div align="center">
    <table class="head-wrap">
        <tr>
            <td class="header container" align="center">
                <div class="content">
                   <a href="http://admin.projecttcc.com.br">
                       <h3><b><?php echo htmlspecialchars( $empresa, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></h3>
                   </a>
                </div>
            </td>
        </tr>
    </table>

    <table class="body-wrap w320">
        <tr>
            <td class="container">
                <div class="content">
                    <table cellspacing="0">
                        <tr>
                            <td>
                                <table class="soapbox">
                                    <tr>
                                        <td class="soapbox-title"><b>Recupera&ccedil;&atilde;o de Senha</b></td>
                                    </tr>
                                </table>
                                <table class="body">
                                    <tr>
                                        <td class="body-padding"></td>
                                        <td class="body-padded">
                                            <div class="body-title">Ol&aacute; <?php echo htmlspecialchars( $name, ENT_COMPAT, 'UTF-8', FALSE ); ?>,</div>
                                            <table class="body-text">
                                                <tr>
                                                    <td class="body-text-cell">
                                                        Para redefinir a sua senha acesse o link
                                                    </td>
                                                <tr>
                                                    <td><a href="<?php echo htmlspecialchars( $link, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $link, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>.</td>
                                                </tr>
                                                </tr>
                                                <tr>
                                                    <td><a id="btn-redefine" href="<?php echo htmlspecialchars( $link, ENT_COMPAT, 'UTF-8', FALSE ); ?>" align="center">Redefinir Senha</a></td>
                                                </tr>
                                            </table>

                                            <table class="body-signature-block">
                                                <tr>
                                                    <td class="body-signature-cell">
                                                        <p>Obrigado!</p>
                                                        <p class="body-signature pull-right">Copyright &copy; <?php echo getAnoAtual(); ?> </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="body-padding"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

</div>

</body>
</html>
