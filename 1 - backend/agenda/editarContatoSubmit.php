<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

session_start();
$usuario_logado = $_SESSION['usuario_logado'];

if (!empty($_POST['id'])) {
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
    
    // ✅ Manter o usuario_id original do contato
    $info = $contato->buscar($id);
    $usuario_id = $info['usuario_id'];
    
    // Se for admin, edita diretamente. Se for usuário normal, verifica propriedade.
    if ($usuario_logado['permissao'] === 'admin' || $usuario_logado['permissao'] === 'super') {
        $contato->editar($id, $nome, $endereco, $email, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo);
    } else {
        $contato->editar($id, $nome, $endereco, $email, $telefone, $sociais, $profissao, $dataNasc, $foto, $ativo, $usuario_logado['id']);
    }
    
    header("Location: index.php?sucesso=Contato atualizado com sucesso");
    exit;
} else {
    header("Location: index.php?erro=Erro ao editar contato");
    exit;
}
?>