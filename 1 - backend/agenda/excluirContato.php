<?php
require_once 'auth.php';
verificarLogin();
// verificarPermissao('contatos.excluir'); // COMENTE ESTA LINHA

require 'inc/header.inc.php';
include 'classes/contatos.class.php';
$contato = new Contatos();

$usuario_logado = getUsuarioLogado();

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // ✅ Verificar se o contato pertence ao usuário
    $info = $contato->buscar($id, $usuario_logado['id']);
    
    if (!empty($info['email'])) {
        // Usuário é dono do contato, pode excluir
        $sucesso = $contato->excluir($id, $usuario_logado['id']);
    } else if (temPermissao('admin', false)) {
        // Admin pode excluir qualquer contato
        $sucesso = $contato->excluir($id);
    } else {
        // Não tem permissão
        header("Location: acesso_negado.php");
        exit;
    }
    
    if ($sucesso) {
        header("Location: index.php?sucesso=Contato excluído com sucesso");
    } else {
        header("Location: index.php?erro=Erro ao excluir contato");
    }
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>