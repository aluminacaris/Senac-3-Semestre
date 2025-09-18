<?php

include 'classes/usuario.class.php';
$usuario = new usuario();

if (!empty($_POST['email'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissao = $_POST['permissao'];

    $usuario->adicionar($nome, $email, $senha, $permissao);
    header("Location: index.php");
} else {
    echo '<script type="text/javascript">alert("Preencha todos os campos obrigatórios.")</script>';
}
