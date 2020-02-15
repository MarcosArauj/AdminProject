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

    public $status_cadastro = "ativo";

    // Salvar Funcionario/Usuario
    public function salvarFuncionario(){
        $sql = new Sql();

        $tipo_usuario = 2; //Funcionário

        $results =  $sql->select("CALL sp_funcionario_salvar(:primeiro_nome,:sobrenome,:data_nascimento,:sexo,:naturalidade,:uf_nascimento,:cpf,:rg,
        :numero_ctps,:serie_ctps,:data_ctps,:estado_ctps,:pis,:cargo_id,:dtadmissao,:status_funcionario,:telefone,:celular,:email,:cep,:rua,:numero,:bairro,
        :cidade,:estado,:pais,:usuario,:senha,:acesso,:tipo_usuario,:status_usuario,:responsavel_cadastro)",array(
            ":primeiro_nome"=>utf8_decode($this->getprimeiro_nome()),
            ":sobrenome"=>utf8_decode($this->getsobrenome()),
            ":data_nascimento"=>$this->getdata_nascimento(),
            ":sexo"=>$this->getsexo(),
            ":naturalidade"=>$this->getnaturalidade(),
            "uf_nascimento"=>$this->getuf_nascimento(),
            ":cpf"=>Validacao::tiraMascaraCpf($this->getcpf()),
            ":rg"=>$this->getrg(),
            ":numero_ctps"=>$this->getnumero_ctps(),
            ":serie_ctps"=>$this->getserie_ctps(),
            ":data_ctps"=>$this->getdata_ctps(),
            ":estado_ctps"=>$this->getestado_ctps(),
            ":pis"=>$this->getpis(),
            ":cargo_id"=>$this->getcargo_id(),
            ":dtadmissao"=>$this->getdtadmissao(),
            ":status_funcionario"=>$this->status_cadastro,
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
            ":tipo_usuario"=>$tipo_usuario,
            ":status_usuario"=>$this->status_cadastro,
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()

        ));

        if (count($results) === 0) {

            throw new \Exception("Erro ao Cadastrar Funcionario!");

        }

        $this->setData($results[0]);

    }

    // Pegar dados de Usuario/Funcionario
    public function get($id_usuario) {
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_usuario as u 
                INNER JOIN tb_pessoa_fisica as pf ON u.pessoaf_id = pf.id_pessoaf
                INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                INNER JOIN tb_funcionario f ON u.funcionario_id = f.id_funcionario  
                INNER JOIN tb_cargo_funcionario as ca ON f.cargo_id = ca.id_cargo
                WHERE u.id_usuario = :id_usuario", array(
            ":id_usuario"=>$id_usuario
        ));

        $data = $results[0];

        $data['primeiro_nome'] = utf8_encode($data['primeiro_nome']);
        $data['sobrenome'] = utf8_encode($data['sobrenome']);

        $this->setData($data);
    }


    public static function listarFuncionario() {
        $sql = new Sql();

        return $sql->select(" SELECT * FROM tb_usuario as u 
                INNER JOIN tb_pessoa_fisica as pf ON u.pessoaf_id = pf.id_pessoaf
                INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                INNER JOIN tb_funcionario f ON u.funcionario_id = f.id_funcionario
                INNER JOIN tb_cargo_funcionario as ca ON f.cargo_id = ca.id_cargo
                WHERE f.status_funcionario = :status
                ORDER BY p.primeiro_nome" , array(
            ":status"=>'ativo'
             ));
        // WHERE u.cargo = 'Administrador'
    }

    public static function ckecarPisExiste($pis){
        $sql = new Sql();

        $results =  $sql->select("SELECT * FROM tb_funcionario
                WHERE pis = :pis", array(
            ":pis"=>$pis
        ));

        return (count($results) > 0);

    }

    // atualizar dados do Funcionaraio
    public function atualizarFuncionario(){
        $sql = new Sql();

        $results =  $sql->select("CALL sp_funcionario_atualizar(:id_usuario,:primeiro_nome,:sobrenome,:rg,:numero_ctps,:serie_ctps,:data_ctps,
        :estado_ctps,:pis,:cargo_id,:telefone,:celular,:email,:cep,:rua,:numero,:bairro,:cidade,:estado,:pais,:usuario,:acesso,:responsavel_cadastro)",array(
            ":id_usuario"=>$this->getid_usuario(),
            ":primeiro_nome"=>utf8_decode($this->getprimeiro_nome()),
            ":sobrenome"=>utf8_decode($this->getsobrenome()),
            ":rg"=>$this->getrg(),
            ":numero_ctps"=>$this->getnumero_ctps(),
            ":serie_ctps"=>$this->getserie_ctps(),
            ":data_ctps"=>$this->getdata_ctps(),
            ":estado_ctps"=>$this->getestado_ctps(),
            ":pis"=>$this->getpis(),
            ":cargo_id"=>$this->getcargo_id(),
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

        $sql->query("CALL sp_altera_status_funcionario(:id_usuario,:status_funcionario,:status_usuario,:responsavel_cadastro)", array(
            ":id_usuario"=>$this->getid_usuario(),
            ":status_funcionario"=>$this->getstatus_funcionario(),
            ":status_usuario"=>$this->getstatus_usuario(),
            ":responsavel_cadastro"=>$this->getresponsavel_cadastro()
        ));

    }

    public static function getPage($pagina = 1, $itemsPerPage = 10) {

        $start = ($pagina - 1) * $itemsPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_usuario as u 
                INNER JOIN tb_pessoa_fisica as pf ON u.pessoaf_id = pf.id_pessoaf
                INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                INNER JOIN tb_funcionario f ON u.funcionario_id = f.id_funcionario
                INNER JOIN tb_cargo_funcionario as ca ON f.cargo_id = ca.id_cargo 
                WHERE f.status_funcionario = 'ativo' AND u.tipo_usuario = 2
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


        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_usuario as u
                INNER JOIN tb_pessoa_fisica as pf ON u.pessoaf_id = pf.id_pessoaf
                INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                INNER JOIN tb_funcionario f ON u.funcionario_id = f.id_funcionario
                INNER JOIN tb_cargo_funcionario as ca ON f.cargo_id = ca.id_cargo
                WHERE f.status_funcionario = 'ativo' AND pf.primeiro_nome LIKE :busca OR c.email = :busca
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

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_usuario as u
                INNER JOIN tb_pessoa_fisica as pf ON u.pessoaf_id = pf.id_pessoaf
                INNER JOIN tb_contato as c ON pf.contato_id = c.id_contato
                INNER JOIN tb_endereco as e ON pf.endereco_id = e.id_endereco
                INNER JOIN tb_funcionario f ON u.funcionario_id = f.id_funcionario
                INNER JOIN tb_cargo_funcionario as ca ON f.cargo_id = ca.id_cargo
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
