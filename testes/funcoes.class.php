<?php 

 class Funcoes {
    public function dtNasc($vlr, $tipo){
        switch($tipo){
            case 1:
                // PostgreSQL para formato brasileiro (yyyy-mm-dd → dd/mm/yyyy)
                $rst = implode("/", array_reverse(explode("-", $vlr)));
                break;
            case 2:
                // Formato brasileiro para PostgreSQL (dd/mm/yyyy → yyyy-mm-dd)
                $rst = implode("-", array_reverse(explode("/", $vlr)));
                break;
            default:
                $rst = $vlr;
        }
        return $rst;
}
 }
 ?>