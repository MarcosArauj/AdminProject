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
use project\validacao\Validacao;
use App\config\DB\Sql;


class Usuario extends Model {

    const SESSION = "Usuario";
    const SECRET = "Casa_Nova_Secret";
    const STATUSUSUARIO = "ativo";


    public static function listUsuario() {
        $sql = new Sql();


        $results =  $sql->select("SELECT * FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    ORDER BY pf.primeiro_nome" , array(
                    ":status"=>'ativo'
                     ));

        return (count($results) > 0);

       // WHERE u.cargo = 'Administrador'
    }
    // Pegar dados de Usuario/Funcionario e Cliente para recuparar a senha
    public function getUsuarioSenha($id_usuario) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE u.id_usuario = :id_usuario",array(
            ":id_usuario"=>$id_usuario,
        ));

        $data = $results[0];

        $data["primeiro_nome"] = utf8_encode($data["primeiro_nome"] );

        $this->setData($data);
    }

    // Pegar dados de Usuario/Funcionario e Cliente
    public function getUsuario($id_usuario,$tipo_usuario) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE u.id_usuario = :id_usuario AND u.tipo_usuario = :tipo_usuario",array(
                    ":id_usuario"=>$id_usuario,
                    ":tipo_usuario"=>$tipo_usuario  // 2 - Funcionario/ 3 - Cliente
                 ));

        $data = $results[0];

        $data["primeiro_nome"] = utf8_encode($data["primeiro_nome"] );

        $this->setData($data);
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

    // Proprietario e Funcionarios e Cliente
    public function salvarUsuario(){

        $sql = new Sql();

        $results =  $sql->select("CALL sp_usuario_admin_cliente_salvar(:primeiro_nome,:sobrenome,:data_nascimento,:sexo,:naturalidade,:uf_nascimento,
        :cpf,:rg,:telefone,:celular,:email,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:usuario,:senha,:acesso,:tipo_usuario,:status_usuario,:responsavel_cadastro)",array(
            ":primeiro_nome"=>$this->getprimeiro_nome(),
            ":sobrenome"=>$this->getsobrenome(),
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
            ":status_usuario"=>Usuario::STATUSUSUARIO,
            ":responsavel_cadastro"=>utf8_decode($this->getprimeiro_nome())

        ));

        $this->setData($results[0]);
    }

//atualiza usuario Logado Proprietario/Funcionário/Cliente
    public function atualizaUsuario(){

        $sql = new Sql();

        $results =  $sql->select("CALL sp_usuario_admin_cliente_atualizar(:id_usuario,:primeiro_nome,:sobrenome,
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

    // Ativar de Desativar Usuario Funcionario ou Cliente
    public function alteraStatusUsuario(){
        $sql = new Sql();

        $sql->query("CALL sp_altera_status_usuario(:id_usuario,:status_usuario,:responsavel_cadastro)", array(
            ":id_usuario"=>$this->getid_usuario(),
            ":status_usuario"=>$this->getstatus_usuario(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));

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

    public static function getPage($pagina = 1,$tipo_usuario, $itemsPerPage = 10) {

        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *  FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE u.tipo_usuario = :tipo_usuario AND u.status_usuario = 'ativo'
                    ORDER BY pf.primeiro_nome
                    LIMIT $start, $itemsPerPage;",array(
            ':tipo_usuario' => $tipo_usuario
        ));

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );

    }


    public static function getPageBusca($busca,$tipo_usuario,$pagina = 1, $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();


        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *  FROM tb_usuario as u
                    INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                    INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                    INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                    WHERE u.tipo_usuario = :tipo_usuario AND u.status_usuario = 'ativo'
                    AND pf.primeiro_nome LIKE :busca OR c.email = :busca
                    ORDER BY pf.primeiro_nome
                    LIMIT $start, $itemsPerPage;",array(
            ":busca"=>'%'.$busca.'%',
            ':tipo_usuario' => $tipo_usuario
        ));

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );
    }

    public static function getBuscaUsuario($busca,$tipo_usuario,$pagina = 1, $itemsPerPage = 7){
        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $cpf_sem_mascara =  Validacao::tiraMascaraCpf($busca);

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *  FROM tb_usuario as u
                        INNER JOIN tb_pessoa_fisica as pf ON u.pessoa_id = pf.id_pessoaf
                        INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                        INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                        WHERE u.tipo_usuario = :tipo_usuario AND pf.cpf LIKE :busca 
                        ORDER BY pf.primeiro_nome
                        LIMIT $start, $itemsPerPage;",array(
            ":busca"=>'%'.$cpf_sem_mascara.'%',
            ":tipo_usuario"=>$tipo_usuario
        ));

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal" );

        return array(
            'data'=>$results,
            'total'=>(int)$resultTotal[0]["nrtotal"],
            'paginas'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
        );
    }


}
