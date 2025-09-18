<?php
class Conexao {
    private $usuario;
    private $senha;
    private $banco;
    private $servidor;
    private $porta;
    private static $pdo;

    public function __construct() {
        $this->servidor = "localhost";
        $this->banco = "agendaSenac2025";
        $this->usuario = "postgres";
        $this->senha = "pedro";
        $this->porta = "5432";
    }

    public function conectar() {
        try {
            if (is_null(self::$pdo)) {
                // String de conexão PostgreSQL
                $dsn = "pgsql:host=$this->servidor;port=$this->porta;dbname=$this->banco";
                
                self::$pdo = new PDO($dsn, $this->usuario, $this->senha);
                
                // Configurar PDO para lançar exceções em caso de erro
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Opcional: Configurar charset
                self::$pdo->exec("SET NAMES 'UTF8'");
            }
            
            return self::$pdo;
            
        } catch (PDOException $ex) {
            die("Erro de conexão: " . $ex->getMessage());
        }
    }

    // Método para fechar conexão (opcional, pois PDO gerencia automaticamente)
    public function desconectar() {
        self::$pdo = null;
        return true;
    }

    // Método para verificar se está conectado
    public function estaConectado() {
        return !is_null(self::$pdo);
    }
}

// Exemplo de uso:
$conexao = new Conexao();

// Conectar
$pdo = $conexao->conectar();

// Verificar se está conectado
if ($conexao->estaConectado()) {
    echo "Conectado com sucesso ao PostgreSQL!<br>";
    
    // Exemplo de query (opcional)
    try {
        $stmt = $pdo->query("SELECT version() as postgres_version");
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Versão do PostgreSQL: " . $resultado['postgres_version'] . "<br>";
    } catch (PDOException $e) {
        echo "Erro na query: " . $e->getMessage();
    }
}

// Fechar conexão (normalmente não é necessário, mas disponível)
// $conexao->desconectar();
// echo "Desconectado com sucesso!";
?>