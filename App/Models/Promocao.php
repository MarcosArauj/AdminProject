<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 15/11/2018
 * Time: 16:26
 */

namespace App\Models;

use project\model\Model;
use project\model\Paginacao;
use App\config\DB\Sql;

class Promocao extends Model implements Paginacao {


    public function listarPromocoes(){
        $sql = new Sql();

        $results =   $sql->select(" SELECT * FROM tb_promocao ORDER BY dtfinal");

        if (count($results) > 0) {
            $data = $results[0];

            $this->setData($data);
        }
    }

    public static function checkList($list){
        foreach ($list as &$row){
            $promocao = new Promocao();
            $promocao->setData($row);
            $row = $promocao->getValues();
        }

        return $list;
    }

    public static function ckecarPromocaoExiste($nome_promocao, $descricao) {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_promocao 
            WHERE nome_promocao = :nome_promocao AND descricao = :descricao", array(
            ":nome_promocao"=>$nome_promocao,
            ":descricao"=>$descricao,

        ));

        return (count($results) > 0);

    }

    /// Salvar/atualizar Promoção
    public function salvarPromocao(){
        $sql = new Sql();

        $results = $sql->select(
            "CALL sp_promocao_salvar(:id_promocao,:nome_promocao,:dtinicio,:dtfinal,:url_promocao,:descricao,:responsavel_cadastro)",array(
            ":id_promocao"=>$this->getid_promocao(),
            ":nome_promocao"=>$this->getnome_promocao(),
            ":dtinicio"=>$this->getdtinicio(),
            ":dtfinal"=>$this->getdtfinal(),
            ":url_promocao"=>$this->geturl_promocao(),
            ":descricao"=>$this->getdescricao(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));

        if (count($results) === 0) {

            throw new \Exception("Erro ao Cadastrar Promocao!");

        }


        $this->setData($results[0]);

    }

    public function getPromocao($id_promocao) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_promocao
             WHERE id_promocao= :id_promocao",array(
            ":id_promocao"=>$id_promocao
        ));

        $data = $results[0];

        $this->setData($data);
    }

    public function getFromPromocaoURL($url_promocao) {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_promocao
             WHERE url_promocao = :url_promocao",array(
            ":url_promocao"=>$url_promocao
        ));

        $data = $results[0];

        $this->setData($data);

    }

    public function excluirPromocao(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_promocao WHERE id_promocao = :id_promocao",array(
            ":id_promocao"=>$this->getid_promocao()
        ));

    }

    public function checkFotoPromocao(){
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR. "vendor". DIRECTORY_SEPARATOR. "project". DIRECTORY_SEPARATOR .
            "res". DIRECTORY_SEPARATOR. "imageSite". DIRECTORY_SEPARATOR . "site". DIRECTORY_SEPARATOR . "promocoes" . DIRECTORY_SEPARATOR . $this->getid_promocao() . ".jpg")){

            $url_promocao = "/vendor/project/res/imageSite/site/promocoes/" . $this->getid_promocao() . ".jpg";

        } else {
            $url_promocao =  "/vendor/project/res/imageSite/site/promocoes.jpg";
        }

        return $this->setfoto_promocao($url_promocao);

    }

    public function getValues() {

        $this->checkFotoPromocao();

        $values =  parent::getValues();

        return $values;

    }

    public function setFotoPromocao($foto_promocao) {

        $extension = explode('.',$foto_promocao['name']);
        $extension = end($extension);

        switch ($extension) {

            case "jpg":case "jpeg":
            $image = imagecreatefromjpeg($foto_promocao["tmp_name"]);
            break;
            case "git":
                $image = imagecreatefromgif($foto_promocao["tmp_name"]);
                break;
            case "png":
                $image = imagecreatefrompng($foto_promocao["tmp_name"]);
                break;

        }

        $dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "vendor". DIRECTORY_SEPARATOR. "project". DIRECTORY_SEPARATOR."res". DIRECTORY_SEPARATOR.
            "imageSite". DIRECTORY_SEPARATOR . "site". DIRECTORY_SEPARATOR . "promocoes" . DIRECTORY_SEPARATOR . $this->getid_promocao() . ".jpg";

        imagejpeg($image, $dist);

        imagedestroy($image);

        $this->checkFotoPromocao();
    }


    public static function getPage($pagina = 1 , $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $data_atual = date('Y-m-d');

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_promocao
                ORDER BY $data_atual < dtfinal  LIMIT $start, $itemsPerPage;");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );
    }

    public static function getPageBusca($busca, $pagina = 1, $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $data_atual = date('Y-m-d');

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_promocao
                WHERE nome_promocao LIKE :busca 
                ORDER BY $data_atual < dtfinal  
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
