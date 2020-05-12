<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 19/03/2019
 * Time: 14:19
 */

namespace App\Models\Email;

use PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\Exception;
use Rain\Tpl;

class Mailer {

    private $mail;

    public function __construct($username,$password, $name,$toAddress,$toName,$subject,$tplName,$data = array()){

        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/App/Views/email/",
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/App/Views-cache/",
            "debug"         => false // set to false to improve the speed
        );

        Tpl::configure( $config );

        $tpl = new Tpl;

        foreach ($data as $key => $value){
            $tpl->assign($key,$value);
        }

        $html = $tpl->draw($tplName,true);

        //Create a new PHPMailer instance
        $this->mail = new PHPMailer();
        //Tell PHPMailer to use SMTP
        $this->mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $this->mail->SMTPDebug = 1;
        ////Ask for HTML-friendly debug output
        $this->mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $this->mail->Host = 'smtp.hostinger.com.br';
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        // use
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $this->mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $this->mail->SMTPSecure = false;
        //Whether to use SMTP authentication
        $this->mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $this->mail->Username = $username;
        //Password to use for SMTP authentication
        $this->mail->Password = $password;
        //Set who the message is to be sent from
        $this->mail->setFrom($username, $name);
        //Set who the message is to be sent to
        $this->mail->addAddress($toAddress, $toName);
        //Set the subject line
        $this->mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $this->mail->msgHTML($html);
        //Replace the plain text body with one created manually
        $this->mail->AltBody = $name;

    }

    public function send() {

        return $this->mail->send();

    }


}
