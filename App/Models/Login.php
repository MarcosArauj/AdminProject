<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 22/12/2018
 * Time: 08:07
 */

namespace App\Models;


use App\config\DB\Sql;


class Login  extends Usuario {

    // Ligin Administrativo
    public static function loginAdmin($login, $senha){

        $db = new Sql();

        $results = $db->select("SELECT * FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE  usuario = :login AND status_usuario = :status",
            array(
                ":login"=>$login,
                ":status"=>"ativo",
            ));

        if (count($results) === 0) {


            throw new \Exception("Usuário ou Senha inválidos");

        }

        $data = $results[0];

        if (password_verify($senha, $data["senha"])) {

            if ($data['tipo_usuario'] == 3){

                throw new \Exception("Você não tem acesso a esse Sistema!!!");
            } else {

                $usuario = new Usuario();

                $usuario->setData($data);

                $_SESSION[Usuario::SESSION] = $usuario->getValues();

                return $usuario;
            }


        } else {

            throw new \Exception("Usuário ou Senha inválidos!");


        }

    }

    // Pega dados do Usuario Logado
    public static function getFromSession(){

        $usuario = new Usuario();

        if (isset($_SESSION[Usuario::SESSION]) && (int)$_SESSION[Usuario::SESSION]['id_usuario'] >0) {
            $usuario->setData($_SESSION[Usuario::SESSION]);
        }

        return $usuario;

    }

  //Verifcar o Usuario logado e Tipo de acesso permitido
    public static function checkLogin($acesso = true){
        if (!isset($_SESSION[Usuario::SESSION])
            ||
            !$_SESSION[Usuario::SESSION]
            ||
            !(int)$_SESSION[Usuario::SESSION]["id_usuario"] > 0) {
            //Não esta logado
            return false;
        } else {
            if($acesso === true && (bool)$_SESSION[Usuario::SESSION]["acesso"] === true) {
                return true;

            } else if($acesso === false){
                return true;

            } else {
                return false;
            }
        }

    }

    public static function logout(){

        $_SESSION[Usuario::SESSION] = NULL;

    }

    public static function verifyLogin($acesso = true) {

        if (Login::checkLogin($acesso)) {

            return true;

        } else if (Login::checkLogin($acesso = false)) {
            return true;
        } else {
            header("Location: /");
            exit;
        }

    }

}
