<?php
require_once 'auth.php';
verificarLogin();

// COMENTE ESTA LINHA para que qualquer usuário logado possa editar seus próprios contatos,
// ou descomente para exigir a permissão 'contatos.editar'
// verificarPermissao('contatos.editar');

require 'inc/header.inc.php';
include 'classes/contatos.class.php';

$contatos = new Contatos();
$usuario_logado = getUsuarioLogado();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar contato verificando se pertence ao usuário
    $info = $contatos->buscar($id, $usuario_logado['id']);

    if (empty($info['email'])) {
        // Se não encontrou, verificar se é admin
        if (temPermissao('admin', false)) {
            $info = $contatos->buscar($id); // Admin pode editar qualquer um
        }

        if (empty($info['email'])) {
            header("Location: acesso_negado.php");
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<h1>Editar Contato</h1>

<a href="index.php" class="btn-voltar">← Voltar para Início</a>

<?php
// Mensagens de feedback
if (isset($_GET['sucesso'])) {
    echo '<div class="sucesso">' . htmlspecialchars($_GET['sucesso']) . '</div>';
}
if (isset($_GET['erro'])) {
    echo '<div class="erro">' . htmlspecialchars($_GET['erro']) . '</div>';
}
?>

<form method="POST" action="editarContatoSubmit.php" class="formulario">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($info['id']); ?>">

    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($info['nome']); ?>" required /><br><br>

    <label>Endereço:</label>
    <input type="text" name="endereco" value="<?php echo htmlspecialchars($info['endereco']); ?>" /><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($info['email']); ?>" required /><br><br>

    <label>Telefone:</label>
    <input type="text" name="telefone" value="<?php echo htmlspecialchars($info['telefone']); ?>" /><br><br>

    <label>Redes Sociais:</label>
    <input type="text" name="sociais" value="<?php echo htmlspecialchars($info['sociais']); ?>" /><br><br>

    <label>Profissão:</label>
    <input type="text" name="profissao" value="<?php echo htmlspecialchars($info['profissao']); ?>" /><br><br>

    <label>Data de Nascimento:</label>
    <input type="date" name="dataNasc" value="<?php echo htmlspecialchars($info['dataNasc']); ?>" /><br><br>

    <label>Foto:</label>
    <input type="text" name="foto" value="<?php echo htmlspecialchars($info['foto']); ?>" /><br><br>

    <input type="submit" value="Salvar Edição" class="botao" />
</form>

<?php include 'inc/footer.inc.php'; ?>