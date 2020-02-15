<?php


namespace App\Models;


use App\config\DB\Sql;
use project\model\Model;
use project\model\Paginacao;
use project\validacao\Validacao;


class Fornecedor extends Model implements Paginacao {

    protected $status_cadastro = "ativo";

    public function get($id_fornecedor) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_fornecedor as f
                INNER JOIN tb_pessoa_juridica as pj ON f.pessoaj_id = pj.id_pessoaj
                INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco
                WHERE f.id_fornecedor = :id_fornecedor",array(
            ":id_fornecedor"=>$id_fornecedor
            ));

        if (count($results) > 0) {

            $data = $results[0];

            $data['nome_fantasia'] = utf8_encode($data['nome_fantasia']);
            $data['razao_social'] = utf8_encode($data['razao_social']);

            $this->setData($data);

        }
    }

    public function listarFornecedores() {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_fornecedor as f
                INNER JOIN tb_pessoa_juridica as pj ON f.pessoaj_id = pj.id_pessoaj
                INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco
                WHERE f.status_fornecedor = :status
                ORDER BY pj.nome_fantasia", array(
            ":status"=>'ativo'
        ));

        if (count($results) > 0) {

            $data = $results;

            $data['nome_fantasia'] = utf8_encode($data['nome_fantasia']);
            $data['razao_social'] = utf8_encode($data['razao_social']);

            $this->setData($data);

        }

    }

    public static function ckecarCnpjExiste($cnpj){
        $sql = new Sql();

        $cnpj_sem_mascara =  Validacao::tiraMascaraCnpj($cnpj);

        $results =  $sql->select("SELECT * FROM tb_pessoa_juridica 
                WHERE cnpj = :cnpj", array(
            ":cnpj"=>$cnpj_sem_mascara
        ));

        return (count($results) > 0);

    }
    // Salvar e Atualizar cadastro de Fonrnecedores
    public function salvarFornecedor(){

        $sql = new Sql();

        $results =  $sql->select("CALL sp_fornecedor_salvar(:id_fornecedor,:razao_social,:nome_fantasia,:cnpj,:inscricao_municipal,:inscricao_estadual,
        :telefone,:celular,:email,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:status_fornecedor,:responsavel_cadastro)",array(
            ":id_fornecedor"=>$this->getid_fornecedor(),
            ":razao_social"=>utf8_decode($this->getrazao_social()),
            ":nome_fantasia"=>utf8_decode($this->getnome_fantasia()),
            ":cnpj"=>Validacao::tiraMascaraCnpj($this->getcnpj()),
            ":inscricao_municipal"=>$this->getinscricao_municipal(),
            ":inscricao_estadual"=>$this->getinscricao_estadual(),
            ":telefone"=>$this->gettelefone(),
            ":celular"=>$this->getcelular(),
            ":email"=>$this->getemail(),
            ":cep"=>$this->getcep(),
            ":rua"=>$this->getrua(),
            ":numero"=>$this->getnumero(),
            ":bairro"=>$this->getbairro(),
            ":cidade"=>$this->getcidade(),
            ":estado"=>$this->getestado(),
            ":status_fornecedor"=>$this->status_cadastro,
            ":pais"=>$this->getpais(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()

        ));

        if (count($results) === 0) {

            throw new \Exception("$results");

        }

        $this->setData($results[0]);
    }

//Excluir cadastro de Funcionário(alterar status)
    public function alteraStatusFornecedor(){
        $sql = new Sql();

        $sql->query("CALL sp_altera_status_fornecedor(:id_fornecedor,:status_fornecedor,:responsavel_cadastro)", array(
            ":id_fornecedor"=>$this->getid_fornecedor(),
            ":status_fornecedor"=>$this->getstatus_fornecedor(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));

    }



    public static function getPage($pagina = 1 , $itemsPerPage = 8){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_fornecedor as f
                INNER JOIN tb_pessoa_juridica as pj ON f.pessoaj_id = pj.id_pessoaj
                INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco 
                WHERE f.status_fornecedor = 'ativo'
                ORDER BY pj.nome_fantasia
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
        
        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_fornecedor as f
                INNER JOIN tb_pessoa_juridica as pj ON f.pessoaj_id = pj.id_pessoaj
                INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco 
                WHERE f.status_fornecedor = 'ativo' AND pj.nome_fantasia LIKE :busca OR pj.razao_social LIKE :busca OR pj.cnpj LIKE :busca
                ORDER BY pj.nome_fantasia
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

    public static function getBuscaFornecedor($busca, $pagina = 1, $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $cnpj_sem_mascara =  Validacao::tiraMascaraCnpj($busca);

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_fornecedor as f
                INNER JOIN tb_pessoa_juridica as pj ON f.pessoaj_id = pj.id_pessoaj
                INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco 
                WHERE pj.cnpj LIKE :busca 
                ORDER BY pj.nome_fantasia
                LIMIT $start, $itemsPerPage;",array(
            ":busca"=>'%'.$cnpj_sem_mascara.'%'
        ));

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );
    }

}