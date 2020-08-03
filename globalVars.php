<?php
$desarrollo = false;
if ($desarrollo) {
    $env = "http://localhost/TiendaOnline/";
} else{
    $env = "https://zibareal.herokuapp.com/";
}

//$iva = 12;
//$descuento = 1.55;

$nombreEmpresa = "Ziba";
$direccionEmpresa = "Cuenca, Ecuador";
$telefonoEmpresa = "+593 912345678";
$correoEmpresa = "ziba@zibareal.herokuapp.com";

if(!function_exists('intToMes')){
function intToMes($int) {
    switch($int){
        case 1:
            $mes = "Enero";
            break;
        case 2:
            $mes = "Febrero";
            break;
        case 3:
            $mes = "Marzo";
            break;
        case 4:
            $mes = "Abril";
            break;
        case 5:
            $mes = "Mayo";
            break;
        case 6:
            $mes = "Junio";
            break;
        case 7:
            $mes = "Julio";
            break;
        case 8:
            $mes = "Agosto";
            break;
        case 9:
            $mes = "Septiembre";
            break;
        case 10:
            $mes = "Octubre";
            break;
        case 11:
            $mes = "Noviembre";
            break;
        case 11:
            $mes = "Diciembre";
            break;
    }
    return $mes;
}
}

?>