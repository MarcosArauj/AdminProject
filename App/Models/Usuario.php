<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 13/11/2018
 * Time: 16:53
 */

namespace App\Models;

use project\model\Model;
use project\validacao\Validacao;
use App\config\DB\Sql;


class Usuario extends Model  {

    const SESSION = "Usuario";
    const SECRET = "Casa_Nova_Secret";
    public $status_cadastro = "ativo";


    public static function listUsuario() {
        $sql = new Sql();


        $results =  $sql->select("SELECT * FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    ORDER BY pf.primeiro_nome");

        return (count($results) > 0);

       // WHERE u.cargo = 'Administrador'
    }

    public function get($id_usuario) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE u.id_usuario = :id_usuario",array(
                    ":id_usuario"=>$id_usuario
                 ));

        $this->setData($results[0]);
    }


    public static function ckecarCpfExiste($cpf){
        $sql = new Sql();

         $cpf_sem_mascara =  Validacao::tiraMascaraCpf($cpf);

        $results =  $sql->select("SELECT * FROM tb_pessoa_fisica 
                WHERE cpf = :cpf", array(
            ":cpf"=>$cpf_sem_mascara
        ));

        return (count($results) > 0);

    }

    public static function ckecarEmailExiste($email) {

        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_contato  
                WHERE  email = :email", array(
                ":email"=>$email
        ));

        return (count($results) > 0);

    }

    // Proprietario e Funcionarios
    public function salvarUsuario(){

        $sql = new Sql();

        $results =  $sql->select("CALL sp_usuario_admin_salvar(:primeiro_nome,:sobrenome,:data_nascimento,:sexo,:naturalidade,:uf_nascimento,
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
            ":acesso"=>$this->getacesso(),
            ":tipo_usuario"=>$this->gettipo_usuario(),
            ":status_usuario"=>$this->status_cadastro,
            ":responsavel_cadastro"=>utf8_decode($this->getprimeiro_nome())

        ));

        $this->setData($results[0]);
    }

//atualiza usuario Logadp
    public function atualizaUsuario(){

        $sql = new Sql();

        $results =  $sql->select("CALL sp_usuario_admin_atualizar(:id_usuario,:primeiro_nome,:sobrenome,
            :rg,:telefone,:celular,:email,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:usuario,:responsavel_cadastro)",array(
            ":id_usuario"=>$this->getid_usuario(),
            ":primeiro_nome"=>$this->getprimeiro_nome(),
            ":sobrenome"=>$this->getsobrenome(),
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
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()

        ));

        $this->setData($results[0]);
    }

    // atualizar Senha
    public function atualizarSenha(){
        $sql = new Sql();

        $results =  $sql->select("CALL sp_senha_atualizar(:id_usuario,:senha)",array(
            ":id_usuario"=>$this->getid_usuario(),
            ":senha"=>password_hash($this->getsenha(), PASSWORD_DEFAULT,["cost"=>12])
        ));

     //   print_r("   id: ".$this->getid_usuario()."senha: ".$this->getsenha());
        $this->setData($results[0]);

    }


}
