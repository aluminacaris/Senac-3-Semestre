<?php 
include_once "Animal.php";  
include_once "Cachorro.php";
include_once "Pessoa.php";
include_once "Aluno.php";

$c = new Cachorro();
$c->fazerSom();
$c->abrirBoca();
$c->Exista();
echo "<br>";
echo "<br>";

$aluno = new Aluno("Marcio", 20);
echo $aluno->getNome();
echo "<br>";
echo $aluno->getIdade();