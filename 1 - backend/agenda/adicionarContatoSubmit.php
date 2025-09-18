<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

if (!empty($_POST['email'])) {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $sociais = $_POST['sociais'];
    $profissao = $_POST['profissao'];
    $dataNasc = $_POST['dataNasc'];
    $foto = $_POST['foto'];
    $ativo = $_POST['ativo'];
    
    // ✅ Adicionar ID do usuário logado
    session_start();
    $usuario_id = $_SESSION['usuario_logado']['id'];
    
    $contato->adicionar($nome, $email, $endereco, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo, $usuario_id);
    header("Location: index.php");
} else {
    echo '<script type="text/javascript">alert("Preencha todos os campos obrigatórios.")</script>';
}