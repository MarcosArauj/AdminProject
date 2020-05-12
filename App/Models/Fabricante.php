<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 15/11/2018
 * Time: 14:55
 */

namespace App\Models;

use App\config\DB\Sql;

class Fabricante  extends Model implements Paginacao {


    public static function listarFaricante(){
        $sql = new Sql();

        return  $sql->select("SELECT * FROM tb_fabricante_produto ORDER BY nome_fabricante");
    }


    public static function ckecarFabricanteExiste($nome_fabricante) {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_fabricante_produto
                WHERE nome_fabricante = :nome_fabricante", array(
            ":nome_fabricante"=>$nome_fabricante
        ));

        return (count($results) > 0);

    }

    /// Salvar e Atualizar
    public function salvarFabricante(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_fabricante_salvar(:id_fabricante,:nome_fabricante,:responsavel_cadastro)",array(
            ":id_fabricante"=>$this->getid_fabricante(),
            ":nome_fabricante"=>$this->getnome_fabricante(),
            "responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));


        $this->setData($results[0]);

    }

    public function get($id_fabricante) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_fabricante_produto WHERE id_fabricante = :id_fabricante",array(
            ":id_fabricante"=>$id_fabricante
        ));

        $this->setData($results[0]);
    }

    public function excluir(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_fabricante_produto  WHERE id_fabricante = :id_fabricante",array(
            ":id_fabricante"=>$this->getid_fabricante()
        ));;

    }

    public static function getPage($pagina = 1 , $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_fabricante_produto ORDER BY nome_fabricante
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

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_fabricante_produto
                WHERE nome_fabricante LIKE :busca 
                ORDER BY nome_fabricante
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

    // pega produtos relacionados aos fabricantes
    public function getProdutosFabricantes() {

        $sql = new Sql();

        return $sql->select("
                    SELECT * FROM tb_produto_categoria_fabricante as pcf
                     INNER JOIN tb_produto as p ON pcf.produto_id = p.id_produto
                     INNER JOIN tb_fabricante_produto as f ON pcf.fabricante_id = f.id_fabricante
                     INNER JOIN tb_categoria_produto as c ON pcf.categoria_id = c.id_categoria
                     WHERE f.id_fabricante = :id_fabricante ORDER BY pcf.id_pcf",
            array(
                ':id_fabricante'=>$this->getid_fabricante()
            ));

    }


}