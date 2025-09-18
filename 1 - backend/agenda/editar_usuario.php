<?php
require_once 'auth.php';
verificarLogin();
verificarPermissao('usuarios.editar');
?>

<?php
require 'inc/header.inc.php';
require_once __DIR__ . '/classes/usuario.class.php';

if (!class_exists('usuario')) {
    die('Erro: Classe usuario não encontrada');
}

$usuario_class = new usuario();

// Buscar dados do usuário a ser editado
$usuario_edit = null;
if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $usuario_edit = $usuario_class->buscar($id);
    
    if (!$usuario_edit) {
        header("Location: gestao_usuario.php");
        exit;
    }
} else {
    header("Location: gestao_usuario.php");
    exit;
}

// Processar o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $permissao = $_POST['permissao'] ?? 'user';
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    
    // Se a senha não foi alterada, manter a atual
    if (empty($senha)) {
        $senha = $usuario_edit['senha'];
    } else {
        $senha = password_hash($senha, PASSWORD_DEFAULT);
    }
    
    $usuario_class->editar($id, $nome, $email, $senha, $permissao, $ativo);
    
    header("Location: gestao_usuario.php?sucesso=Usuário atualizado com sucesso");
    exit;
}
?>

<h1>Editar Usuário</h1>

<div class="action-buttons">
    <a href="gestao_usuario.php" class="btn-voltar">← Voltar para Gestão</a>
</div>

<form method="POST" action="" class="formulario">
    <input type="hidden" name="id" value="<?php echo $usuario_edit['id']; ?>">
    
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario_edit['nome']); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario_edit['email']); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="senha">Nova Senha (deixe em branco para manter a atual):</label>
        <input type="password" id="senha" name="senha" placeholder="Digite nova senha">
    </div>
    
    <div class="form-group">
        <label for="permissao">Permissão:</label>
        <select id="permissao" name="permissao" required>
            <option value="user" <?php echo $usuario_edit['permissao'] == 'user' ? 'selected' : ''; ?>>Usuário</option>
            <option value="editor" <?php echo $usuario_edit['permissao'] == 'editor' ? 'selected' : ''; ?>>Editor</option>
            <option value="admin" <?php echo $usuario_edit['permissao'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
            <option value="super" <?php echo $usuario_edit['permissao'] == 'super' ? 'selected' : ''; ?>>Super Admin</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="ativo" class="checkbox-label">
            <input type="checkbox" id="ativo" name="ativo" value="1" <?php echo $usuario_edit['ativo'] ? 'checked' : ''; ?>>
            Usuário Ativo
        </label>
    </div>
    
    <input type="submit" value="Salvar Alterações" class="botao">
</form>

<?php include 'inc/footer.inc.php'; ?>