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


    public static function getFromSession(){

        $usuario = new Usuario();

        if (isset($_SESSION[Usuario::SESSION]) && (int)$_SESSION[Usuario::SESSION]['id_usuario'] >0) {
            $usuario->setData($_SESSION[Usuario::SESSION]);
        }

        return $usuario;

    }


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

    public static function login($login, $senha){

        $db = new Sql();

        $results = $db->select("SELECT * FROM tb_usuario
                    WHERE  usuario = :login AND status_usuario = :status",
            array(
                ":login"=>$login,
                ":status"=>"ativo"
            ));

        if (count($results) === 0) {


            throw new \Exception("Usuário ou Senha inválidos");

        }

        $data = $results[0];

        if (password_verify($senha, $data["senha"])) {



            if ($data["tipo_usuario"] == 1 ) {

                $usuario = new Usuario();

                $proprietario = $db->select("SELECT * FROM tb_usuario as u
                    INNER JOIN tb_proprietario as pro ON pro.usuario_id = u.id_usuario 
                    INNER JOIN tb_pessoa_fisica as pf ON pro.pessoaf_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE  u.usuario = :login AND u.status_usuario = :status",
                    array(
                        ":login"=>$login,
                        ":status"=>"ativo"
                    ));

                $data2 = $proprietario[0];

//                $data2['primeiro_nome'] = utf8_encode($data['primeiro_nome']);
//                $data2['sobrenome'] = utf8_encode($data['sobrenome']);

                $usuario->setData($data2);
                $_SESSION[Usuario::SESSION] = $usuario->getValues();

                return $usuario;

            } else if($data["tipo_usuario"] == 2) {
                $usuario = new Usuario();

                  $funcionario = $db->select("SELECT * FROM tb_funcionario as fun
                        INNER JOIN tb_usuario as u ON fun.usuario_id = u.id_usuario
                        INNER JOIN tb_pessoa_fisica as pf ON fun.pessoa_id = pf.id_pessoaf
                        INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                        INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                        INNER JOIN tb_cargo_funcionario as ca ON fun.cargo_id = ca.id_cargo
                        WHERE  u.usuario = :login AND u.status_usuario = :status",
                        array(
                            ":login"=>$login,
                            ":status"=>"ativo"
                        ));

                    $data2 = $funcionario[0];

                    $usuario->setData($data2);
                    $_SESSION[Usuario::SESSION] = $usuario->getValues();

                    return $usuario;

            }


          //  $data['primeiro_nome'] = utf8_encode($data['primeiro_nome']);
            //$data['sobrenome'] = utf8_encode($data['sobrenome']);


        } else {

            throw new \Exception("Usuário ou Senha inválidos!");


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
