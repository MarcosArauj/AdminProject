<?php


namespace App\Models;


use App\config\DB\Sql;
use project\validacao\Validacao;


class Proprietario extends Usuario {

    public $status_cadastro = "ativo";

    public static function listarproprietario() {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_usuario as u 
            INNER JOIN tb_pessoa_fisica as pf ON u.pessoaf_id = pf.id_pessoaf
            INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
            INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
            INNER JOIN tb_funcionario f ON u.funcionario_id = f.id_funcionario");

        return (count($results) > 0);
    }

    public function salvarProprietario(){

        $sql = new Sql();

        $tipo_usuario = 1; //Proprietário
        $acesso = 1;

        $results =  $sql->select("CALL sp_proprietario_salvar(:primeiro_nome,:sobrenome,:data_nascimento,:sexo,:naturalidade,:uf_nascimento,
        :cpf,:rg,:telefone,:celular,:email,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:usuario,:senha,:acesso,:tipo_usuario,:status_usuario,:responsavel_cadastro)",array(
            ":primeiro_nome"=>utf8_decode($this->getprimeiro_nome()),
            ":sobrenome"=>utf8_decode($this->getsobrenome()),
            ":data_nascimento"=>$this->getdata_nascimento(),
            ":sexo"=>$this->getsexo(),
            ":naturalidade"=>$this->getnaturalidade(),
            "uf_nascimento"=>$this->getuf_nascimento(),
            ":cpf"=> Validacao::tiraMascaraCpf($this->getcpf()),
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
            ":senha"=>password_hash(Validacao::tiraMascaraCpf($this->getcpf()), PASSWORD_DEFAULT,["cost"=>12]),
            ":acesso"=>$acesso,
            ":tipo_usuario"=>$tipo_usuario,
            ":status_usuario"=>$this->status_cadastro,
            ":responsavel_cadastro"=>utf8_decode($this->getprimeiro_nome())

        ));

        print_r($acesso);

        $this->setData($results[0]);
    }

}
