<?php

require 'inc/header.inc.php';
    ?>

    <h1>Adicionar Contato</h1>

    <form method="POST" action="adicionarContatoSubmit.php"  class="formulario">
        Nome:<br>
        <input type="text" name="nome"/><br><br>
        Endereço:<br>
        <input type="text" name="endereco"/><br><br>
        Email:<br>
        <input type="email" name="email"/><br><br>
        Telefone:<br>
        <input type="text" name="telefone"/><br><br>
        Redes Sociais:<br>
        <input type="text" name="sociais"/><br><br>
        Profissão:<br>
        <input type="text" name="profissao"/><br><br>
        Data de Nascimento:<br>
        <input type="date" name="dataNasc"/><br><br>
        Foto:<br>
        <input type="text" name="foto"/><br><br>
        Ativo:<br>
        <input type="text" name="ativo"/><br><br>

        <input type="submit" value="Adicionar Contato"  class="botao"/>
    </form>

    <?php
    require 'inc/footer.inc.php';
    ?>