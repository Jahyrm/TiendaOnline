<?php 
if (isset($_GET['m'])) {
        switch($_GET['m']) {
            case 0:
                if(isset($_GET['a'])){
                    if(isset($_GET['s'])){
                        $mensaje = "Tenemos ".$_GET['s']." de este producto en stock. Y ya tienes agregado ".$_GET['a'].".";
                    }
                } else {
                    if(isset($_GET['s'])){
                        $mensaje = "Tenemos ".$_GET['s']." de este producto en stock.";
                    }
                }
                break;
            case 1:
                $mensaje = "No se pudo agregar el producto al carrito.";
                break;
            case 2:
                $mensaje = "Debes iniciar sesión para agregar productos.";
                break;
            case 3:
            case 6:
                $mensaje = "No puedes acceder manualmente.";
                break;
            case 4:
                $mensaje = "No se pudo eliminar el producto del carrito.";
                break;
            case 5:
                $mensaje = "Debes iniciar sesión para eliminar productos.";
                break;
            case 7:
                $mensaje = "No hay productos en el carrito para actualizar.";
                break;
            case 8:
                $mensaje = "Debes iniciar sesión para actualizar productos.";
                break;
        }
}
?>