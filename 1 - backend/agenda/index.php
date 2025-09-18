<?php
require_once 'auth.php';
verificarLogin();
?>

<?php
include 'inc/header.inc.php';
include 'classes/contatos.class.php';
include 'classes/funcoes.class.php';

$contatos = new Contatos();
$fn = new Funcoes();

// ✅ Buscar contatos APENAS do usuário logado (exceto para admins)
$usuario_logado = getUsuarioLogado();

if (temPermissao('admin')) {
    $lista = $contatos->listar(); // Admin vê todos
} else {
    $lista = $contatos->listar($usuario_logado['id']); // Usuário vê apenas os seus
}

// Mensagens de feedback
if (isset($_GET['sucesso'])) {
    echo '<div class="sucesso">' . htmlspecialchars($_GET['sucesso']) . '</div>';
}
if (isset($_GET['erro'])) {
    echo '<div class="erro">' . htmlspecialchars($_GET['erro']) . '</div>';
}
?>

<h1>Lista de Contatos</h1>

<?php if (temPermissao('admin')): ?>
    <p class="info-admin">👑 Visualizando todos os contatos do sistema</p>
<?php else: ?>
    <p class="info-usuario">📋 Visualizando seus contatos pessoais</p>
<?php endif; ?>

<div class="action-buttons">
    <a href="adicionarContato.php" class="botaocontato">Adicionar Contato</a>

    <?php if (temPermissao('usuarios.ver')): ?>
        <a href="gestao_usuario.php" class="botaousuario">Gestão de Usuários</a>
    <?php endif; ?>
</div>

<table border="1" width="100%">
    <tr class="header-row">
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>TELEFONE</th>
        <th>PROFISSÃO</th>
        <?php if (temPermissao('admin')): ?>
            <th>USUÁRIO</th>
        <?php endif; ?>
        <th>AÇÕES</th>
    </tr>
    <?php if (empty($lista)): ?>
        <tr>
            <td colspan="<?php echo temPermissao('admin') ? '7' : '6'; ?>" style="text-align: center;">
                <?php if (temPermissao('admin')): ?>
                    Nenhum contato encontrado no sistema.
                <?php else: ?>
                    Você ainda não tem contatos. <a href="adicionarContato.php">Adicione o primeiro!</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php else: ?>
        <?php foreach ($lista as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['nome']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['telefone']; ?></td>
                <td><?php echo $item['profissao']; ?></td>
                <?php if (temPermissao('admin')): ?>
                    <td>ID: <?php echo $item['usuario_id']; ?></td>
                <?php endif; ?>
                <td>
                    <?php
                    // ✅ VERIFICAR SE O USUÁRIO PODE EDITAR/EXCLUIR ESTE CONTATO
                    $pode_editar = false;
                    $pode_excluir = false;

                    // Admin pode tudo
                    if (temPermissao('admin', false)) {
                        $pode_editar = true;
                        $pode_excluir = true;
                    }
                    // Usuário normal só pode editar/excluir seus próprios contatos
                    else if ($item['usuario_id'] == $usuario_logado['id']) {
                        $pode_editar = true;
                        $pode_excluir = true;
                    }
                    ?>

                    <?php if ($pode_editar): ?>
                        <a href="editarContato.php?id=<?php echo $item['id']; ?>" class="btn editar">EDITAR</a>
                    <?php else: ?>
                        <span class="btn editar desabilitado" title="Você não pode editar este contato">EDITAR</span>
                    <?php endif; ?>

                    <?php if ($pode_excluir): ?>
                        <a href="excluirContato.php?id=<?php echo $item['id']; ?>" class="btn excluir"
                            onclick="return confirm('Tem certeza que deseja excluir este contato?');">EXCLUIR</a>
                    <?php else: ?>
                        <span class="btn excluir desabilitado" title="Você não pode excluir este contato">EXCLUIR</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php include 'inc/footer.inc.php'; ?>