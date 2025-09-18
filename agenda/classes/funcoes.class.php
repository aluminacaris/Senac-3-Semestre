<?php 

 class Funcoes {
    public function dtNasc($vlr, $tipo){
        switch($tipo){
            case 1:
                $rst = implode("-", array_reverse(explode("/", $vlr))); // converte de dd/mm/yyyy para yyyy-mm-dd
                break;
            case 2:
                $rst = implode("/", array_reverse(explode("-", $vlr))); // converte de yyyy-mm-dd para dd/mm/yyyy
                break;
        }
        return $rst;
    }
 }
 ?>