<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 22/03/2019
 * Time: 16:29
 */

namespace App\Models;


use App\Models\Email\Mailer;
use App\config\DB\Sql;


class RecuperaSenha  extends  Usuario {

    public static function getEmailRecuperaSenha($email) {


        $sql = new Sql();



        $results = $sql->select(
            "SELECT * FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE c.email = :email", array(
            ":email"=>$email
        ));

        if (count($results) === 0) {
            throw new \Exception("Não foi possivel recuperar a senha. E-mail não cadastrado");
        } else {
            $data = $results[0];

            $results_recovery = $sql->select("CALL sp_recupera_senha(:id_usuario,:ip)",array(
                ":id_usuario"=>$data["id_usuario"],
                ":ip"=>$_SERVER["REMOTE_ADDR"]
            ));

            if(count($results_recovery) === 0 ) {
                throw new \Exception("Não foi possivel recuperar a senha.");
            } else {
                $data_recovery = $results_recovery[0];

               $code = base64_encode( $data_recovery["id_recupera"]);

	            $link = "http://admin.projecttcc.com.br/recupera-senha/esqueci/recupera?code=$code";

                $empresa = new Empresa();
                $empresa->dadosempresa();

	            $email = new Mailer(
	                $empresa->getemail(),
	                $empresa->getsenha(),
	                $empresa->getnome_fantasia(),
	                $data["email"],
                    $data["primeiro_nome"],
                    "Redefinir senha - ". $empresa->getnome_fantasia(),
                    "esqueci",
                    array(
                       "name"=>$data["primeiro_nome"],
                        "link"=>$link,
                        "empresa"=>utf8_encode($empresa->getnome_fantasia())
                    ));

                $email->send();

	            return $data;


            }

        }

    }

    public static function validRecuperaDecrypt($code) {

	  $disrecupera =  base64_decode($code);

	  $sql = new Sql();

//	  print_r($disrecupera);

	  $results = $sql->select("SELECT * FROM
	  tb_recupera_senha as r 
	  INNER JOIN tb_usuario as u ON r.id_usuario = u.id_usuario
	  INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
	  WHERE r.id_recupera = :id_recupera AND 
	  r.dtrecuperacao IS NULL AND 
	  DATE_ADD(r.dtregistro, INTERVAL 1 HOUR) >= NOW()", array(
	      ":id_recupera"=>$disrecupera
      ));

    // print_r($results);

	  if(count($results) === 0) {
          throw new \Exception("Não foi possivel recuperar a senha!");
      } else {
	      return $results[0];
      }
	}

	public static function setRecuperaUsada($id_recupera){
        $sql = new Sql();

        $sql->query("UPDATE tb_recupera_senha SET 
        dtrecuperacao = NOW() WHERE id_recupera = :id_recupera", array(
            ":id_recupera"=>$id_recupera
        ));

    }

}
