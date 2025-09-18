<?php
require_once 'auth.php';
require 'inc/header.inc.php';
verificarLogin(); // Descomente se quiser forçar login
?>

<h1>Adicionar Contato</h1>

<a href="index.php" class="btn-voltar">← Voltar para Início</a>

<?php
// ✅ Mensagens de feedback
if (isset($_GET['sucesso'])) {
    echo '<div class="sucesso">' . htmlspecialchars($_GET['sucesso']) . '</div>';
}
if (isset($_GET['erro'])) {
    echo '<div class="erro">' . htmlspecialchars($_GET['erro']) . '</div>';
}
?>

<form method="POST" action="adicionarContatoSubmit.php" class="formulario">
    <label>Nome:</label>
    <input type="text" name="nome" required /><br><br>

    <label>Endereço:</label>
    <input type="text" name="endereco" /><br><br>

    <label>Email:</label>
    <input type="email" name="email" required /><br><br>

    <label>Telefone:</label>
    <input type="text" name="telefone" /><br><br>

    <label>Redes Sociais:</label>
    <input type="text" name="sociais" /><br><br>

    <label>Profissão:</label>
    <input type="text" name="profissao" /><br><br>

    <label>Data de Nascimento:</label>
    <input type="date" name="dataNasc" /><br><br>

    <label>Foto:</label>
    <input type="text" name="foto" /><br><br>

    <label>Ativo:</label>
    <select name="ativo">
        <option value="1">Sim</option>
        <option value="0">Não</option>
    </select><br><br>

    <input type="submit" value="Adicionar Contato" class="botao" />
</form>

<?php
require 'inc/footer.inc.php';
?>
