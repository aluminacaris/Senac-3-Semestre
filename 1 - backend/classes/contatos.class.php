<?php
require 'conexao.class.php';

class Contatos
{
    private $id;
    private $nome;
    private $endereco;
    private $email;
    private $telefone;
    private $sociais;
    private $profissao;
    private $dataNasc;
    private $foto;
    private $ativo;
    private $con;
    public function __construct()
    {
        $this->con = new Conexao();
    }
    private function existeEmail($email)
    {
        $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        } else {
            $array = array();
        }
        return $array;
    }
    public function adicionar($email, $nome, $endereco, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo)
    {
        try {
            $email = trim($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return 'Email inválido';
            }

            // Verificar se email já existe
            $emailExistente = $this->existeEmail($email);
            if (!empty($emailExistente)) {
                return 'Email já existe no sistema';
            }

            $sql = $this->con->conectar()->prepare("INSERT INTO contatos 
            (nome, endereco, email, telefone, sociais, profissao, dataNasc, foto, ativo) 
            VALUES (:nome, :endereco, :email, :telefone, :sociais, :profissao, :dataNasc, :foto, :ativo)");

            $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
            $sql->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $sql->bindParam(":sociais", $sociais, PDO::PARAM_STR);
            $sql->bindParam(":profissao", $profissao, PDO::PARAM_STR);
            $sql->bindParam(":dataNasc", $dataNasc, PDO::PARAM_STR);
            $sql->bindParam(":foto", $foto, PDO::PARAM_STR);
            $sql->bindParam(":ativo", $ativo, PDO::PARAM_INT);

            return $sql->execute() ? true : 'Erro na execução da query';
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }
    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM contatos");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return array();
        }
    }
    public function buscar($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetch();
            } else {
                return array();
            }
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }

    }
    public function editar($id, $nome, $endereco, $email, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo)
    {
        try {
            $sql = $this->con->conectar()->prepare("UPDATE contatos SET 
            nome = :nome, 
            endereco = :endereco, 
            email = :email, 
            telefone = :telefone, 
            sociais = :sociais, 
            profissao = :profissao, 
            dataNasc = :dataNasc, 
            foto = :foto, 
            ativo = :ativo 
            WHERE id = :id");

            $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
            $sql->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $sql->bindParam(":sociais", $sociais, PDO::PARAM_STR);
            $sql->bindParam(":profissao", $profissao, PDO::PARAM_STR);
            $sql->bindParam(":dataNasc", $dataNasc, PDO::PARAM_STR);
            $sql->bindParam(":foto", $foto, PDO::PARAM_STR);
            $sql->bindParam(":ativo", $ativo, PDO::PARAM_STR);
            $sql->bindParam(":id", $id, PDO::PARAM_INT);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    // REMOVER o método deletar() duplicado ou corrigi-lo:
    public function deletar($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM contatos WHERE id = :id");
            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

}// Fim da classe