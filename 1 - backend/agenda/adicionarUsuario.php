<?php
require_once 'auth.php';
verificarLogin(); // Isso redirecionará para login se não estiver logado
?>

<?php
require 'inc/header.inc.php';

require_once __DIR__ . '/classes/usuario.class.php';
if (!class_exists('usuario')) {
    die('Erro: Classe usuario não encontrada em classes/usuario.class.php');
}

$usuario = new usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $permissao = $_POST['permissao'] ?? '';

    $usuario->adicionar($nome, $email, $senha, $permissao);
    header("Location: gestao_usuario.php");
    exit;
}

?>

<h1>Adicionar Usuário</h1>

<a href="gestao_usuario.php" class="btn-voltar">← Voltar para Gestão</a>

<form method="post" class="formulario">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    
    <label for="permissao">Permissão:</label>
    <select id="permissao" name="permissao">
        <option value="user">Usuário</option>
        <option value="admin">Administrador</option>
        <option value="super">Super Usuário</option>
    </select>
    
    <input type="submit" value="Adicionar" class="botao">
</form>

<?php
require 'inc/footer.inc.php';
?>