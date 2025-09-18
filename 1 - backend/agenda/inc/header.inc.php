<?php
// No início do header.inc.php
if (basename($_SERVER['PHP_SELF']) != 'login.php' && !isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>AgendaSenac2025</title>
</head>

<body>

    <header class="site-header">
        <h1>Agenda Senac 2025</h1>
        <nav class="main-navigation">
            <a href="index.php" class="nav-btn">🏠 Início</a>
            <a href="adicionarContato.php" class="nav-btn">➕ Add Contato</a>
            <a href="gestao_usuario.php" class="nav-btn">👥 Usuários</a>
            <?php if (isset($_SESSION['logado'])): ?>
                <a href="?logout=true" class="nav-btn logout-btn">🚪 Sair</a>
                <span class="user-info">Olá, <?php echo $_SESSION['usuario_logado']['nome']; ?></span>
            <?php endif; ?>
        </nav>
    </header>

    <div class="container">