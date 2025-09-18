<?php include 'inc/header.inc.php'; ?>
<?php include 'classes/contatos.class.php';
include 'classes/funcoes.class.php';
$contatos = new Contatos();
$fn = new Funcoes();
?>
<h1>Lista de Contatos</h1>
<button class="botaocontato"><a href="adicionarContato.php">Adicionar Contato</a></button>

<table border="3" width="100%" >
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>ENDEREÇO</th>
        <th>EMAIL</th>
        <th>TELEFONE</th>
        <th>SOCIAIS</th>
        <th>PROFISSÃO</th>
        <th>FOTO</th>
        <th>ATIVO</th>
        <th>NASCIMENTO</th>
        <th>AÇÕES</th>
    </tr>
    <?php
     $lista = $contatos->listar();
     foreach($lista as $item):
    ?>
    <tbody>
        <tr class="header-row">
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['nome']; ?></td>
            <td><?php echo $item['endereco']; ?></td>
            <td><?php echo $item['email']; ?></td>
            <td><?php echo $item['telefone']; ?></td>
            <td><?php echo $item['sociais']; ?></td>
            <td><?php echo $item['profissao']; ?></td>
            <td><?php echo $item['foto']; ?></td>
            <td><?php echo $item['ativo']; ?></td>
            <td><?php echo $fn->dtNasc($item['dataNasc'], 1); ?></td>
            <td>
                <a href="editarContato.php?id=<?php echo $item['id']; ?>" class="btn editar">EDITAR</a>    
                <a href="excluirContato.php?id=<?php echo $item['id']; ?>" class="btn excluir">EXCLUIR</a>    
            <td>
     
        </tr>

    </tbody>
     <?php
      endforeach;
     ?>
</table>


 <?php include 'inc/footer.inc.php'; ?>