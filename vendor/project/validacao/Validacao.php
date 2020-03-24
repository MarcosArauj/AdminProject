<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 04/01/2019
 * Time: 18:23
 */

namespace project\validacao;


class Validacao {

    public static function tiraMascaraCpf($cpf) {
        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        return $cpf;
    }

    public static function validaCPF($cpf) {
        // Verifica se um número foi informado
        if (empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = Validacao::tiraMascaraCpf($cpf);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    public static function tiraMascaraCnpj($cnpj) {
        // Elimina possivel mascara
        $cnpj = str_pad(str_replace(array('.','-','/'),'',$cnpj),14,'0',STR_PAD_LEFT);

        return $cnpj;
    }

    function validaCNPJ($cnpj){

        $cnpj = Validacao::tiraMascaraCnpj($cnpj);

        if (strlen($cnpj) != 14):
            return false;
        else:
            for($t = 12; $t < 14; $t++):
                for($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++):
                    $d += $cnpj{$c} * $p;
                    $p  = ($p < 3) ? 9 : --$p;
                endfor;
                $d = ((10 * $d) % 11) % 10;
                if($cnpj{$c} != $d):
                    return false;
                endif;
            endfor;
            return true;
        endif;
    }

public static function getUsuario($email) {

    $usuario = strstr($email, '@', TRUE);

    return $usuario;
}


}
