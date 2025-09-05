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
        $sql = $this->con->conectar()->prepare(query: "SELECT * FROM contatos WHERE email = :email");
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

            $sql = $this->con->conectar()->prepare( "INSERT INTO contatos 
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

        if ($sql->execute()) {
                return true;
            } else {
                // Log de erro para debugging
                error_log("Erro PDO: " . implode(" - ", $sql->errorInfo()));
                return "Erro na execução da query: " . implode(" - ", $sql->errorInfo());
            }
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
}

        public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare(query: "SELECT * FROM contatos");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return array();
        }
    }

}