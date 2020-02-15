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


    public static function listAll() {
        $sql = new Sql();


        return $sql->select(" SELECT * FROM tb_usuario as u 
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoaf_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    INNER JOIN tb_funcionario f ON u.funcionario_id = f.id_funcionario 
                    INNER JOIN tb_cargo_funcionario as ca ON f.cargo_id = ca.id_cargo
                    ORDER BY pf.primeiro_nome");

       // WHERE u.cargo = 'Administrador'
    }

    public function get($id_usuario) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_usuario as u 
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoaf_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    INNER JOIN tb_funcionario f ON u.funcionario_id = f.id_funcionario 
                    INNER JOIN tb_cargo_funcionario as ca ON f.cargo_id = ca.id_cargo
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


//atualizar dados de Usuario Funcionnario
 public function atualizarUsuario(){

     $sql = new Sql();

     $results =  $sql->select("CALL sp_usuario_atualizar(:id_usuario,:primeiro_nome,:sobrenome,:rg,:numero_ctps,:serie_ctps,:data_ctps,
        :estado_ctps,:pis,:telefone,:celular,:email,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:usuario,:responsavel_cadastro)",array(
         ":id_usuario"=>$this->getid_usuario(),
         ":primeiro_nome"=>utf8_decode($this->getprimeiro_nome()),
         ":sobrenome"=>utf8_decode($this->getsobrenome()),
         ":rg"=>$this->getrg(),
         ":numero_ctps"=>$this->getnumero_ctps(),
         ":serie_ctps"=>$this->getserie_ctps(),
         ":data_ctps"=>$this->getdata_ctps(),
         ":estado_ctps"=>$this->getestado_ctps(),
         ":pis"=>$this->getpis(),
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

   //  echo json_encode($this->getValues());

     $this->setData($results[0]);

  }

   //atualiza usuario Proprietario
    public function atualizaProprietario(){

        $sql = new Sql();

        $results =  $sql->select("CALL sp_proprietario_atualizar(:id_usuario,:primeiro_nome,:sobrenome,
            :rg,:telefone,:celular,:email,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:usuario,:responsavel_cadastro)",array(
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
