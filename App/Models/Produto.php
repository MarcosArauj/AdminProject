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

class Produto extends Model implements Paginacao {

    public static function listarProduto(){
        $sql = new Sql();

        return  $sql->select("SELECT * FROM tb_produto_categoria_fabricante as pcf
            INNER JOIN tb_produto as p ON pcf.produto_id = p.id_produto
            INNER JOIN tb_fabricante_produto as f ON pcf.fabricante_id = f.id_fabricante
            INNER JOIN tb_categoria_produto as c ON pcf.categoria_id = c.id_categoria
            ORDER BY p.nome_produto");
    }

    public static function checkList($list){
        foreach ($list as &$row){
            $produto = new Produto();
            $produto->setData($row);
            $row = $produto->getValues();
        }

        return $list;
    }

    public static function ckecarProdutoExiste($nome_produto, $fabricante, $descricao) {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_produto_categoria_fabricante as pcf
            INNER JOIN tb_produto as p ON pcf.produto_id = p.id_produto
            INNER JOIN tb_fabricante_produto as f ON pcf.fabricante_id = f.id_fabricante
            INNER JOIN tb_categoria_produto as c ON pcf.categoria_id = c.id_categoria
            WHERE p.nome_produto = :nome_produto AND pcf.fabricante_id = :fabricante_id AND p.descricao = :descricao", array(
            ":nome_produto"=>$nome_produto,
            ":fabricante_id"=>$fabricante,
            ":descricao"=>$descricao,

        ));

        return (count($results) > 0);

    }

    /// Salvar Produto
    public function salvarProduto(){
        $sql = new Sql();

        $results = $sql->select(
            "CALL sp_produto_salvar(:nome_produto,:fabricante_id,:categoria_id,:preco,:quantidade,:descricao,:url,:responsavel_cadastro)",array(
            ":nome_produto"=>utf8_decode($this->getnome_produto()),
            ":fabricante_id"=>$this->getfabricante_id(),
            ":categoria_id"=>$this->getcategoria_id(),
            ":preco"=>$this->getpreco(),
            ":quantidade"=>$this->getquantidade(),
            ":descricao"=>utf8_decode($this->getdescricao()),
            ":url"=>$this->geturl(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));

        if (count($results) === 0) {

            throw new \Exception("Erro ao Cadastrar Produto!");

        }


        $this->setData($results[0]);

    }

    public function get($id_pcf) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_produto_categoria_fabricante as pcf
             INNER JOIN tb_produto as p ON pcf.produto_id = p.id_produto
             INNER JOIN tb_fabricante_produto as f ON pcf.fabricante_id = f.id_fabricante
             INNER JOIN tb_categoria_produto as c ON pcf.categoria_id = c.id_categoria
             WHERE pcf.id_pcf = :id_pcf",array(
            ":id_pcf"=>$id_pcf
        ));

        $data = $results[0];

        $data['nome_produto'] = utf8_encode($data['nome_produto']);
        $data['descricao'] = utf8_encode($data['descricao']);

        $this->setData($data);
    }

    public function getFromURL($url) {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_produto_categoria_fabricante as pcf
             INNER JOIN tb_produto as p ON pcf.produto_id = p.id_produto
             INNER JOIN tb_fabricante_produto as f ON pcf.fabricante_id = f.id_fabricante
             INNER JOIN tb_categoria_produto as c ON pcf.categoria_id = c.id_categoria
             WHERE p.url = :url",array(
            ":url"=>$url
        ));

        $data = $results[0];

        $data['nome_produto'] = utf8_encode($data['nome_produto']);
        $data['descricao'] = utf8_encode($data['descricao']);

        $this->setData($data);

    }

// atualizar Produto
    public function atualizarProduto(){
        $sql = new Sql();

        $results = $sql->select(
            "CALL sp_produto_atualizar(:id_pcf,:nome_produto,:preco,:descricao,:fabricante_id,:categoria_id,:responsavel_cadastro)",array(
            ":id_pcf"=>$this->getid_pcf(),
            ":nome_produto"=>utf8_decode($this->getnome_produto()),
            ":preco"=>$this->getpreco(),
            ":descricao"=>utf8_decode($this->getdescricao()),
            ":fabricante_id"=>$this->getfabricante_id(),
            ":categoria_id"=>$this->getcategoria_id(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));


        if (count($results) === 0) {

            throw new \Exception("Erro ao Alterar Produto!");

        }

        $this->setData($results[0]);

    }

    public function excluirProduto(){
        $sql = new Sql();

        $sql->query("CALL sp_produto_excluir (:id_pcf)",array(
            ":id_pcf"=>$this->getid_pcf()
        ));;

    }

    public function checkFotoProduto(){
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR. "App". DIRECTORY_SEPARATOR. "Views". DIRECTORY_SEPARATOR .
            "res". DIRECTORY_SEPARATOR. "imageSite". DIRECTORY_SEPARATOR . "site". DIRECTORY_SEPARATOR . "produtos" . DIRECTORY_SEPARATOR . $this->getid_pcf() . ".jpg")){

            $url = "/App/Views/res/imageSite/site/produtos/" . $this->getid_pcf() . ".jpg";

        } else {
            $url =  "/App/Views/res/imageSite/site/produtos.jpg";
        }

        return $this->setfoto_produto($url);

    }

    public function getValues() {

        $this->checkFotoProduto();

        $values =  parent::getValues();


        return $values;

    }

    public function setFotoProduto($foto_produto) {

        $extension = explode('.',$foto_produto['name']);
        $extension = end($extension);

        switch ($extension) {

            case "jpg":case "jpeg":
            $image = imagecreatefromjpeg($foto_produto["tmp_name"]);
            break;
            case "git":
                $image = imagecreatefromgif($foto_produto["tmp_name"]);
                break;
            case "png":
                $image = imagecreatefrompng($foto_produto["tmp_name"]);
                break;

        }

        $dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "App". DIRECTORY_SEPARATOR. "Views". DIRECTORY_SEPARATOR."res". DIRECTORY_SEPARATOR.
            "imageSite". DIRECTORY_SEPARATOR . "site". DIRECTORY_SEPARATOR . "produtos" . DIRECTORY_SEPARATOR . $this->getid_pcf() . ".jpg";

        imagejpeg($image, $dist);

        imagedestroy($image);

        $this->checkFotoProduto();
    }


    public static function getPage($pagina = 1 , $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_produto_categoria_fabricante as pcf
                INNER JOIN tb_produto as p ON pcf.produto_id = p.id_produto
                INNER JOIN tb_fabricante_produto as f ON pcf.fabricante_id = f.id_fabricante
                INNER JOIN tb_categoria_produto as c ON pcf.categoria_id = c.id_categoria 
                ORDER BY pcf.id_pcf LIMIT $start, $itemsPerPage;");

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

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_produto_categoria_fabricante as pcf
                INNER JOIN tb_produto as p ON pcf.produto_id = p.id_produto
                INNER JOIN tb_fabricante_produto as f ON pcf.fabricante_id = f.id_fabricante
                INNER JOIN tb_categoria_produto as c ON pcf.categoria_id = c.id_categoria
                WHERE p.nome_produto LIKE :busca OR f.nome_fabricante = :busca OR c.nome_categoria LIKE :busca
                ORDER BY p.nome_produto
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
