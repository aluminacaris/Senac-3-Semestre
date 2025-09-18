<?php
require 'conexao.class.php';

class usuario
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $permissao;
    private $ativo;
    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    private function existeEmail($email)
    {
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        } else {
            $array = array();
        }
        return $array;
    }

    public function adicionar($nome, $email, $senha, $permissao = 'user', $ativo = 1)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) == 0) {
            try {
                $this->nome = $nome;
                $this->email = $email;
                $this->senha = password_hash($senha, PASSWORD_DEFAULT);
                $this->permissao = $permissao;
                $this->ativo = $ativo;

                $sql = $this->con->conectar()->prepare("INSERT INTO usuario (nome, email, senha, permissao, ativo) VALUES (:nome, :email, :senha, :permissao, :ativo)");
                $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);
                $sql->bindParam(":permissao", $this->permissao, PDO::PARAM_STR);
                $sql->bindParam(":ativo", $this->ativo, PDO::PARAM_INT);

                if ($sql->execute()) {
                    return TRUE;
                } else {
                    return 'Erro ao executar a query';
                }
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return FALSE;
        }
    }
    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {

            return [];
        }
    }

    public function buscar($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE id = :id");
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

    public function editar($id, $nome, $email, $senha, $permissao, $ativo)
    {
        try {
            // Se a senha não foi alterada (já está hasheada)
            if (password_needs_rehash($senha, PASSWORD_DEFAULT)) {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            } else {
                $senhaHash = $senha;
            }

            $sql = "UPDATE usuario SET 
                nome = ?, 
                email = ?, 
                senha = ?, 
                permissao = ?, 
                ativo = ?
                WHERE id = ?";

            $stmt = $this->con->conectar()->prepare($sql);
            $stmt->execute([
                $nome,
                $email,
                $senhaHash,
                $permissao,
                $ativo,
                $id
            ]);

            return true;
        } catch (PDOException $ex) {
            error_log("Erro ao editar usuário: " . $ex->getMessage());
            return false;
        }
    }
    public function excluir($id)
    {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $stmt = $this->con->conectar()->prepare($sql);
        $stmt->execute([$id]);
    }
    public function atualizarUltimoLogin($id)
    {
        try {
            $data_hora = date('Y-m-d H:i:s');
            $sql = $this->con->conectar()->prepare("UPDATE usuario SET ultimo_login = :ultimo_login WHERE id = :id");
            $sql->bindParam(":ultimo_login", $data_hora);
            $sql->bindParam(":id", $id);
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    public function verificarLogin($email, $senha)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE email = :email AND ativo = 1");
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $usuario = $sql->fetch();
                if (password_verify($senha, $usuario['senha'])) {
                    return $usuario;
                }
            }
            return false;
        } catch (PDOException $ex) {
            return false;
        }
    }

}

