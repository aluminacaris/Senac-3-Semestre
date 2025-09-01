<?php 
    class Aluno extends Pessoa{
        public function __construct(string $nome, int $idade){  
            parent::__construct($nome, $idade);
        }
    }