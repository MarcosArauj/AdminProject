<?php


namespace App\Models;

use App\config\DB\Sql;

class EstadosCidades extends Model {

    public static function listarEstado() {
        $sql = new Sql();


        return $sql->select(" SELECT id_estado,uf FROM tb_estados");

        // WHERE u.cargo = 'Administrador'
    }


    public function buscaCidadeEstado($id_estado){
        $sql = new Sql();


        $results =  $sql->select("SELECT * FROM tb_cidades as c
                INNER JOIN tb_estados as e ON c.id_estado = e.id_estado
                WHERE c.id_estado = :id_estado", array(
            ":id_estado"=>$id_estado
        ));

        return (count($results) > 0);

    }
}