<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 13/11/2018
 * Time: 16:53
 */

namespace App\Models;

use project\model\Model;
use project\model\Paginacao;
use App\config\DB\Sql;


class Cargo extends Model implements Paginacao {

    public static function listarCargo(){
        $sql = new Sql();

        return  $sql->select("SELECT * FROM tb_cargo_funcionario WHERE cargo != 'proprietario'
                            ORDER BY cargo ");
    }

    public static function ckecarCargoExiste($cargo) {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_cargo_funcionario
                WHERE cargo = :cargo", array(
            ":cargo"=>$cargo
        ));

        return (count($results) > 0);

    }

    /// Salvar e Atualizar
    public function salvarCargo(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_cargo_salvar(:id_cargo,:cargo,:responsavel_cadastro)",array(
            ":id_cargo"=>$this->getid_cargo(),
            ":cargo"=>$this->getcargo(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));

        $this->setData($results[0]);

    }

    public function get($id_cargo) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_cargo_funcionario WHERE id_cargo = :id_cargo AND cargo != 'proprietario'",array(
            ":id_cargo"=>$id_cargo
        ));

        $this->setData($results[0]);
    }

    public function excluir(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_cargo_funcionario  WHERE id_cargo = :id_cargo",array(
            ":id_cargo"=>$this->getid_cargo()
        ));;

    }


    public static function getPage($pagina = 1 , $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_cargo_funcionario
                WHERE cargo != 'proprietario'
                ORDER BY cargo
                LIMIT $start, $itemsPerPage;");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );
    }

    public static function getPageBusca($busca, $pagina = 1, $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_cargo_funcionario
                WHERE cargo LIKE :busca AND cargo != 'proprietario'
                ORDER BY cargo
                LIMIT $start, $itemsPerPage;",array(
            ":busca"=>'%'.$busca.'%'
        ));

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );
    }

}