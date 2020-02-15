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


class Categoria extends Model implements Paginacao {

    public static function listarCategoria(){
        $sql = new Sql();

        return  $sql->select("SELECT * FROM tb_categoria_produto ORDER BY nome_categoria");
    }

    public static function ckecarCategoriaExiste($nome_categoria) {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_categoria_produto
                WHERE nome_categoria = :nome_categoria", array(
            ":nome_categoria"=>$nome_categoria
        ));

        return (count($results) > 0);

    }

    /// Salvar e Atualizar
    public function salvarCategoria(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_categoria_salvar(:id_categoria,:nome_categoria,:responsavel_cadastro)",array(
            ":id_categoria"=>$this->getid_categoria(),
            ":nome_categoria"=>$this->getnome_categoria(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));

        $this->setData($results[0]);

    }

    public function get($id_categoria) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_categoria_produto WHERE id_categoria = :id_categoria",array(
            ":id_categoria"=>$id_categoria
        ));

        $this->setData($results[0]);
    }

    public function excluir(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_categoria_produto  WHERE id_categoria = :id_categoria",array(
            ":id_categoria"=>$this->getid_categoria()
        ));;

    }


    public static function getPage($pagina = 1 , $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_categoria_produto ORDER BY nome_categoria
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

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_categoria_produto
                WHERE nome_categoria LIKE :busca 
                ORDER BY nome_categoria
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

    public function getProdutosCategorias() {

        $sql = new Sql();

            return $sql->select("
                    SELECT * FROM tb_produto_categoria_fabricante as pcf
                     INNER JOIN tb_produto as p ON pcf.produto_id = p.id_produto
                     INNER JOIN tb_fabricante_produto as f ON pcf.fabricante_id = f.id_fabricante
                     INNER JOIN tb_categoria_produto as c ON pcf.categoria_id = c.id_categoria
                     WHERE c.id_categoria = :id_categoria ORDER BY pcf.id_pcf",
                array(
                    ':id_categoria'=>$this->getid_categoria()
                ));

    }
}