<?php
require_once 'classes/usuario.class.php';


//APAGAR ARQUIVO APÓS CRIAR USUARIO


$usuario = new usuario();

// Criar usuário admin padrão
$resultado = $usuario->adicionar(
    'Administrador', 
    'admin@agenda.com', 
    '123456', 
    'super'
);

if ($resultado === TRUE) {
    echo "Usuário admin criado com sucesso!<br>";
    echo "Email: admin@agenda.com<br>";
    echo "Senha: 123456";
} else {
    echo "Erro ao criar usuário: " . $resultado;
}