<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 20/12/2018
 * Time: 23:04
 */

namespace App\Models;

use project\model\Paginacao;
use App\config\DB\Sql;
use project\validacao\Validacao;


class Funcionario extends Usuario implements Paginacao{

    // Pegar dados de Usuario/Funcionario
    public function getFuncionario($id_usuario) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_usuario as u
                        INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                        INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                        INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                        WHERE u.id_usuario = :id_usuario AND u.tipo_usuario = :tipo_usuario", array(
                        ":id_usuario"=>$id_usuario,
                        ":tipo_usuario"=>2 //Funcionario
                    ));

        $data = $results[0];

        $this->setData($data);
    }


    // atualizar dados do Funcionaraio
    public function atualizarFuncionario(){
        $sql = new Sql();

        $results =  $sql->select("CALL sp_funcionario_atualizar(:id_usuario,:primeiro_nome,:sobrenome,:rg,
        :telefone,:celular,:email,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:usuario,:acesso,:responsavel_cadastro)",array(
            ":id_usuario"=>$this->getid_usuario(),
            ":primeiro_nome"=>utf8_decode($this->getprimeiro_nome()),
            ":sobrenome"=>utf8_decode($this->getsobrenome()),
            ":rg"=>$this->getrg(),
            ":telefone"=>$this->gettelefone(),
            ":celular"=>$this->getcelular(),
            ":email"=>$this->getemail(),
            ":cep"=>$this->getcep(),
            ":rua"=>$this->getrua(),
            ":numero"=>$this->getnumero(),
            ":bairro"=>$this->getbairro(),
            ":cidade"=>$this->getcidade(),
            ":estado"=>$this->getestado(),
            ":pais"=>$this->getpais(),
            ":usuario"=>Validacao::getUsuario($this->getemail()),
            ":acesso"=>$this->getacesso(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()

        ));


        if (count($results) === 0) {

            throw new \Exception("Erro ao Alterar Funcionário!");

        }

        $this->setData($results[0]);

    }

    public function alteraStatusFuncionario(){
        $sql = new Sql();

        $sql->query("CALL sp_altera_status_funcionario(:id_usuario,:status_usuario,:responsavel_cadastro)", array(
            ":id_usuario"=>$this->getid_usuario(),
            ":status_usuario"=>$this->getstatus_usuario(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));

    }

    public static function getPage($pagina = 1, $itemsPerPage = 10) {

        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *  FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE u.status_usuario = 'ativo' AND u.tipo_usuario = 2
                    ORDER BY pf.primeiro_nome
                    LIMIT $start, $itemsPerPage;");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );

    }


    public static function getPageBusca($busca,$pagina = 1, $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();


        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *  FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE u.status_usuario = 'ativo' AND pf.primeiro_nome LIKE :busca OR c.email = :busca
                    AND u.tipo_usuario = 2 
                    ORDER BY pf.primeiro_nome
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

    public static function getBuscaFuncionario($busca,$pagina = 1, $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $cpf_sem_mascara =  Validacao::tiraMascaraCpf($busca);

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *  FROM tb_usuario as u
                        INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                        INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                        INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                        WHERE pf.cpf LIKE :busca 
                        AND u.tipo_usuario = 2
                        ORDER BY pf.primeiro_nome
                        LIMIT $start, $itemsPerPage;",array(
                    ":busca"=>'%'.$cpf_sem_mascara.'%',
                ));

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );
    }

}
