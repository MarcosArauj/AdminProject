<?php


namespace App\Models;


use App\config\DB\Sql;
use project\model\Model;


class Empresa extends Model {

    public static function chegarEmprsa() {

        $sql = new Sql();

        $results =  $sql->select(" SELECT * FROM tb_empresa as ep 
                        INNER JOIN tb_pessoa_juridica as pj ON ep.pessoaj_id = pj.id_pessoaj
                        INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                        INNER JOIN tb_senha_email_empresa as see ON ep.senha_email_id = see.id_senha
                        INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco");

        return (count($results) > 0);
    }


    public function get($id_empresa) {
        $sql = new Sql();

        $results =  $sql->select(" SELECT * FROM tb_empresa as ep 
                    INNER JOIN tb_pessoa_juridica as pj ON ep.pessoaj_id = pj.id_pessoaj
                    INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                    INNER JOIN tb_senha_email_empresa as see ON ep.senha_email_id = see.id_senha
                    INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco
                    WHERE ep.id_empresa = :id_empresa",array(
            ":id_empresa"=>$id_empresa
        ));

        if (count($results) > 0) {

            $data = $results[0];
            
            $data['senha'] = base64_decode($data['senha']);

            $this->setData($data);

        }
    }

    public function getUrl($url_empresa) {
        $sql = new Sql();

        $results =  $sql->select(" SELECT * FROM tb_empresa as ep 
                    INNER JOIN tb_pessoa_juridica as pj ON ep.pessoaj_id = pj.id_pessoaj
                    INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                    INNER JOIN tb_senha_email_empresa as see ON ep.senha_email_id = see.id_senha
                    INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco
                    WHERE ep.url_empresa = :url_empresa",array(
            ":url_empresa"=>$url_empresa
        ));

        if (count($results) > 0) {

            $data = $results[0];

            $data['senha'] = base64_decode($data['senha']);

            $this->setData($data);

        }
    }


    public function dadosempresa() {
        $sql = new Sql();

        $results =  $sql->select(" SELECT * FROM tb_empresa as ep 
                    INNER JOIN tb_pessoa_juridica as pj ON ep.pessoaj_id = pj.id_pessoaj
                    INNER JOIN tb_contato as c ON pj.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pj.endereco_id = e.id_endereco
                    INNER JOIN tb_senha_email_empresa as see ON ep.senha_email_id = see.id_senha
                    WHERE id_empresa > 0");

        if (count($results) > 0) {
            $data = $results[0];

            $data['senha'] = base64_decode($data['senha']);

         //   $data['senha'] = base64_decode($data['senha']);

            $this->setData($data);
        }


    }



    public function salvarEmpresa(){

        $sql = new Sql();

        $results =  $sql->select("CALL sp_empresa_salvar(:id_empresa,:razao_social,:nome_fantasia,:cnpj,:inscricao_municipal,:inscricao_estadual,
        :nome_curto,:url_empresa,:telefone,:celular,:email,:senha,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:responsavel_cadastro)",array(
            ":id_empresa"=>$this->getid_empresa(),
            ":razao_social"=>$this->getrazao_social(),
            ":nome_fantasia"=>$this->getnome_fantasia(),
            ":cnpj"=>$this->getcnpj(),
            ":inscricao_municipal"=>$this->getinscricao_municipal(),
            ":inscricao_estadual"=>$this->getinscricao_estadual(),
            ":nome_curto"=>$this->getnome_curto(),
            ":url_empresa"=>$this->geturl_empresa(),
            ":telefone"=>$this->gettelefone(),
            ":celular"=>$this->getcelular(),
            ":email"=>$this->getemail(),
            ":senha"=>base64_encode($this->getsenha()),
            ":cep"=>$this->getcep(),
            ":rua"=>$this->getrua(),
            ":numero"=>$this->getnumero(),
            ":bairro"=>$this->getbairro(),
            ":cidade"=>$this->getcidade(),
            ":estado"=>$this->getestado(),
            ":pais"=>$this->getpais(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()

        ));

        if (count($results) === 0) {

            throw new \Exception("Erro oa realizar o registro!");

        }

        $this->setData($results[0]);
    }

}
