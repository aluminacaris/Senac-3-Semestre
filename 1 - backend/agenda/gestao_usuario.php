<?php
require_once 'auth.php';
verificarLogin();
verificarPermissao('usuarios.ver');
?>

<?php
require 'inc/header.inc.php';
require_once __DIR__ . '/classes/usuario.class.php';

if (!class_exists('usuario')) {
    die('Erro: Classe usuario não encontrada em classes/usuario.class.php');
}

$usuario = new usuario();

// ✅ MOVER A DECLARAÇÃO DA LISTA PARA ANTES DAS AÇÕES
$lista = $usuario->listar();

if (!empty($_GET['excluir'])) {
    if (!temPermissao('usuarios.excluir', false)) {
        header("Location: acesso_negado.php");
        exit;
    }

    $usuario->excluir(intval($_GET['excluir']));
    header("Location: gestao_usuario.php");
    exit;
}

if (isset($_GET['sucesso'])) {
    echo '<div class="sucesso">' . htmlspecialchars($_GET['sucesso']) . '</div>';
}
?>

<h1>Gestão de Usuários</h1>

<div class="action-buttons">
    <a href="index.php" class="btn-voltar">← Voltar para Início</a>
    <?php if (temPermissao('usuarios.criar')): ?>
        <a href="adicionarUsuario.php" class="botaocontato">➕ Adicionar Usuário</a>
    <?php endif; ?>
</div>

<table border="1" width="100%">
    <tr class="header-row">
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Permissão</th>
        <th>Ativo</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($lista as $usuarioItem): ?>
        <tr>
            <td><?php echo $usuarioItem['id']; ?></td>
            <td><?php echo $usuarioItem['nome']; ?></td>
            <td><?php echo $usuarioItem['email']; ?></td>
            <td><?php echo $usuarioItem['permissao']; ?></td>
            <td><?php echo $usuarioItem['ativo'] ? 'Sim' : 'Não'; ?></td>
            <td>
                <?php if (temPermissao('usuarios.editar')): ?>
                    <a href="editar_usuario.php?id=<?php echo $usuarioItem['id']; ?>" class="btn editar">Editar</a>
                <?php endif; ?>

                <?php if (temPermissao('usuarios.excluir')): ?>
                    <a href="gestao_usuario.php?excluir=<?php echo $usuarioItem['id']; ?>" class="btn excluir"
                        onclick="return confirm('Confirma exclusão?');">Excluir</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'inc/footer.inc.php'; ?>