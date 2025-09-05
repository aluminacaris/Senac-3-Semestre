<?php

include 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_POST['email'])){
   $nome = $_POST['nome'];
   $endereco = $_POST['endereco'];
   $email = $_POST['email'];
   $telefone = $_POST['telefone'];
   $sociais = $_POST['sociais'];
   $profissao = $_POST['profissao'];
   $dataNasc = $_POST['dataNasc'];
   $foto = $_POST['foto'];
   $ativo = $_POST['ativo'];

   $contato->adicionar($email, $nome, $endereco, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo);
   header("Location: index.php");
}else{
    echo '<script type="text/javascript">alert("Preencha todos os campos obrigatórios.")</script>';
}
