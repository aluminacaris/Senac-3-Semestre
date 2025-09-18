<?php

include 'classes/contatos.class.php';
$contato = new Contatos();

if (
    !empty($_POST['id']) &&
    !empty($_POST['nome']) &&
    !empty($_POST['email'])
) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'] ?? '';
    $email = $_POST['email'];
    $telefone = $_POST['telefone'] ?? '';
    $sociais = $_POST['sociais'] ?? '';
    $profissao = $_POST['profissao'] ?? '';
    $dataNasc = $_POST['dataNasc'] ?? '';
    $foto = $_POST['foto'] ?? '';
    $ativo = $_POST['ativo'] ?? 1;

    $contato->editar($id, $nome, $endereco, $email, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo);
    header("Location: index.php");
    exit;
} else {
    echo '<script type="text/javascript">alert("Preencha todos os campos obrigatórios.")</script>';
}
