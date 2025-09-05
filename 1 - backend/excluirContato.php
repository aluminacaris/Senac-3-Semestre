<?php
require 'inc/header.inc.php';
include 'classes/contatos.class.php';
$contato = new Contatos();

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Buscar informações para confirmar
    $info = $contato->buscar($id);
    
    if(empty($info)) {
        header("Location: index.php");
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Confirmou a exclusão
        $contato->deletar($id);
        header("Location: index.php");
        exit;
    }
    ?>
    
    <h1>Confirmar Exclusão</h1>
    <p>Deseja realmente excluir o contato: <strong><?php echo $info['nome']; ?></strong>?</p>
    
    <form method="POST">
        <input type="submit" value="SIM, Excluir" class="btn excluir"/>
        <a href="index.php" class="btn editar">Cancelar</a>
    </form>

    <?php
} else {
    echo '<script type="text/javascript">alert("ID do contato não informado.")</script>';
    header("Location: index.php");
    exit;
}

require 'inc/footer.inc.php';
?>