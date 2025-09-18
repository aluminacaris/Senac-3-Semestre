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
    private $usuario_id;
    private $con;
    
    public function __construct()
    {
        $this->con = new Conexao();
    }
    
    private function existeEmail($email, $usuario_id = null)
    {
        try {
            if ($usuario_id) {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE email = :email AND usuario_id = :usuario_id");
                $sql->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            } else {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE email = :email");
            }
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->execute();
            
            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            } else {
                $array = array();
            }
            return $array;
        } catch (PDOException $ex) {
            return array();
        }
    }
    
    public function adicionar($nome, $email, $endereco, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo, $usuario_id)
    {
        // Verificar se email já existe para este usuário
        $emailExistente = $this->existeEmail($email, $usuario_id);
        if (count($emailExistente) == 0) {
            try {
                $this->nome = $nome;
                $this->endereco = $endereco;
                $this->email = $email;
                $this->telefone = $telefone;
                $this->sociais = $sociais;
                $this->profissao = $profissao;
                $this->dataNasc = $dataNasc;
                $this->foto = $foto;
                $this->ativo = $ativo;
                $this->usuario_id = $usuario_id;
                
                $sql = $this->con->conectar()->prepare("INSERT INTO contatos (nome, endereco, email, telefone, sociais, profissao, dataNasc, foto, ativo, usuario_id) VALUES (:nome, :endereco, :email, :telefone, :sociais, :profissao, :dataNasc, :foto, :ativo, :usuario_id)");
                
                $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $sql->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
                $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                $sql->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
                $sql->bindParam(":sociais", $this->sociais, PDO::PARAM_STR);
                $sql->bindParam(":profissao", $this->profissao, PDO::PARAM_STR);
                $sql->bindParam(":dataNasc", $this->dataNasc, PDO::PARAM_STR);
                $sql->bindParam(":foto", $this->foto, PDO::PARAM_STR);
                $sql->bindParam(":ativo", $this->ativo, PDO::PARAM_INT);
                $sql->bindParam(":usuario_id", $this->usuario_id, PDO::PARAM_INT);
                
                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return FALSE;
        }
    }
    
    public function listar($usuario_id = null)
    {
        try {
            if ($usuario_id) {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE usuario_id = :usuario_id ORDER BY nome");
                $sql->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            } else {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos ORDER BY nome");
            }
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            error_log("Erro ao listar contatos: " . $ex->getMessage());
            return array();
        }
    }
    
    public function buscar($id, $usuario_id = null)
    {
        try {
            if ($usuario_id) {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE id = :id AND usuario_id = :usuario_id");
                $sql->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
            } else {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE id = :id");
            }
            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            
            if ($sql->rowCount() > 0) {
                return $sql->fetch();
            } else {
                return array();
            }
        } catch (PDOException $ex) {
            error_log("Erro ao buscar contato: " . $ex->getMessage());
            return array();
        }
    }
    
    public function editar($id, $nome, $endereco, $email, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo, $usuario_id = null)
    {
        try {
            // Verificar se o email já existe para outro contato do mesmo usuário
            if ($usuario_id) {
                $emailExistente = $this->existeEmail($email, $usuario_id);
                if (count($emailExistente) > 0 && $emailExistente['id'] != $id) {
                    return false; // Email já existe para outro contato
                }
            }
            
            if ($usuario_id) {
                $sql = "UPDATE contatos SET 
                    nome = ?, endereco = ?, email = ?, telefone = ?, sociais = ?, 
                    profissao = ?, dataNasc = ?, foto = ?, ativo = ?
                    WHERE id = ? AND usuario_id = ?";
                $params = [$nome, $endereco, $email, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo, $id, $usuario_id];
            } else {
                $sql = "UPDATE contatos SET 
                    nome = ?, endereco = ?, email = ?, telefone = ?, sociais = ?, 
                    profissao = ?, dataNasc = ?, foto = ?, ativo = ?
                    WHERE id = ?";
                $params = [$nome, $endereco, $email, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo, $id];
            }
            
            $stmt = $this->con->conectar()->prepare($sql);
            $stmt->execute($params);
            
            return $stmt->rowCount() > 0;
        } catch (PDOException $ex) {
            error_log("Erro ao editar contato: " . $ex->getMessage());
            return false;
        }
    }
    
    public function excluir($id, $usuario_id = null)
    {
        try {
            if ($usuario_id) {
                $sql = "DELETE FROM contatos WHERE id = ? AND usuario_id = ?";
                $params = [$id, $usuario_id];
            } else {
                $sql = "DELETE FROM contatos WHERE id = ?";
                $params = [$id];
            }
            
            $stmt = $this->con->conectar()->prepare($sql);
            $stmt->execute($params);
            
            return $stmt->rowCount() > 0;
        } catch (PDOException $ex) {
            error_log("Erro ao excluir contato: " . $ex->getMessage());
            return false;
        }
    }
    
    public function contarContatosUsuario($usuario_id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT COUNT(*) as total FROM contatos WHERE usuario_id = :usuario_id");
            $sql->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $sql->execute();
            
            $resultado = $sql->fetch();
            return $resultado['total'];
        } catch (PDOException $ex) {
            error_log("Erro ao contar contatos: " . $ex->getMessage());
            return 0;
        }
    }
    
    public function buscarPorEmail($email, $usuario_id = null)
    {
        try {
            if ($usuario_id) {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE email LIKE :email AND usuario_id = :usuario_id");
                $sql->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
            } else {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE email LIKE :email");
            }
            $emailParam = "%$email%";
            $sql->bindValue(':email', $emailParam, PDO::PARAM_STR);
            $sql->execute();
            
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            error_log("Erro ao buscar por email: " . $ex->getMessage());
            return array();
        }
    }
    
    public function buscarPorNome($nome, $usuario_id = null)
    {
        try {
            if ($usuario_id) {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE nome LIKE :nome AND usuario_id = :usuario_id");
                $sql->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
            } else {
                $sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE nome LIKE :nome");
            }
            $nomeParam = "%$nome%";
            $sql->bindValue(':nome', $nomeParam, PDO::PARAM_STR);
            $sql->execute();
            
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            error_log("Erro ao buscar por nome: " . $ex->getMessage());
            return array();
        }
    }
}