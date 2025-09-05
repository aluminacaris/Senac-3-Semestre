<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_POST['email']) && !empty($_POST['id'])){
   $id = $_POST['id'];
   $nome = $_POST['nome'];
   $endereco = $_POST['endereco'];
   $email = $_POST['email'];
   $telefone = $_POST['telefone'];
   $sociais = $_POST['sociais'];
   $profissao = $_POST['profissao'];
   $dataNasc = $_POST['dataNasc'];
   $foto = $_POST['foto'];
   $ativo = $_POST['ativo'];

   // Debug: verificar os dados recebidos
   echo "<pre>Dados recebidos:";
   print_r($_POST);
   echo "</pre>";
   
   // CORREÇÃO: Chamar o método editar() em vez de adicionar()
   $resultado = $contato->editar($id, $nome, $endereco, $email, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo);
   
   // Debug: verificar o resultado
   echo "<pre>Resultado: ";
   var_dump($resultado);
   echo "</pre>";
   
   if($resultado === TRUE) {
       header("Location: index.php");
       exit;
   } else {
       echo "Erro ao editar: " . $resultado;
   }
} else {
    echo '<script type="text/javascript">alert("Preencha todos os campos obrigatórios.")</script>';
    echo "<pre>POST data:";
    print_r($_POST);
    echo "</pre>";
}