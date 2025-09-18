<?php
require_once 'auth.php';
verificarLogin();
?>
<?php include 'inc/header.inc.php'; ?>

<div class="acesso-negado">
    <h1>⛔ Acesso Negado</h1>
    <p>Você não possui permissão para acessar esta página.</p>
    <a href="index.php" class="btn-voltar">Voltar para o Início</a>
</div>

<?php include 'inc/footer.inc.php'; ?>