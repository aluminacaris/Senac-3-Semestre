<?php

require 'inc/header.inc.php';

include 'classes/contatos.class.php';
$contato = new Contatos();

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $contato->excluir($id);
    header("Location: index.php");
    exit;
} else {
    echo '<script type="text/javascript">alert("ID do contato não informado.")</script>';
}
?>

<h1>Excluir Contato</h1>

<form method="POST" action="adicionarContatoSubmit.php">
    Nome:<br>
    <input type="text" name="nome"/><br><br>
    Endereço:<br>
    <input type="text" name="endereco"/><br><br>
    Email:<br>
    <input type="mail" name="email"/><br><br>
    Telefone:<br>
    <input type="text" name="telefone"/><br><br>
    Redes Sociais:<br>
    <input type="text" name="sociais"/><br><br>
    Profissão:<br>
    <input type="text" name="profissao"/><br><br>
    Data de Nascimento:<br>
    <input type="date" name="dataNasc"/><br><br>
    Foto:<br>
    <input type="text" name="foto"/><br><br>
    Ativo:<br>
    <input type="text" name="ativo"/><br><br>

    <input type="submit" value="Adicionar Contato"/>
</form>

<?php
require 'inc/footer.inc.php';
?>