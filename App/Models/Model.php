<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 13/11/2018
 * Time: 16:51
 */

namespace App\Models;

abstract class Model{

    private $values = Array();

    const ERROR = "Erro";
    const ERROR_REGISTER = "UsuarioErroRegistro";
    const SUCCESS = "Sucesso";

    public function __call($name, $args) {

        $method = substr($name, 0, 3);
        $fieldName = substr($name, 3, strlen($name));

        switch ($method) {
            case "get":
                return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL ;
                break;

            case "set":
                $this->values[$fieldName] = $args[0];
                break;
        }

    }

    public function setData($data = array()) {

        foreach ($data as $key => $value) {
            $this->{"set".$key}($value);

        }

    }

    public function getValues() {

        return $this->values;

    }

    //------Mensagens-----------------------//

    public static function setError($msg) {
        $_SESSION[Model::ERROR] = $msg;
    }

    public static function getError() {
        $msg = (isset($_SESSION[Model::ERROR]) && $_SESSION[Model::ERROR]) ? $_SESSION[Model::ERROR] : '';

        Model::clearError();

        return $msg;
    }

    public static function clearError() {
        $_SESSION[Model::ERROR] = NULL;
    }

    public static function setErrorRegister($msg) {
        $_SESSION[Model::ERROR_REGISTER] = $msg;
    }


    public static function setSuccess($msg) {
        $_SESSION[Model::SUCCESS] = $msg;
    }

    public static function getSuccess() {
        $msg = (isset($_SESSION[Model::SUCCESS]) && $_SESSION[Model::SUCCESS]) ? $_SESSION[Model::SUCCESS] : '';

        Model::clearSuccess();

        return $msg;
    }

    public static function clearSuccess() {
        $_SESSION[Model::SUCCESS] = NULL;
    }






}
