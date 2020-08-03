<?php if (isset($_GET['m'])) {
        $colorError = false;

        switch($_GET['m']) {
            case 1:
                $mensaje = "Categoría creada.";
                break;
            case 2:
                $colorError = true;
                $mensaje = "No se pudo crear la categoría.";
                break;
            case 3:
            case 6:
            case 9:
            case 12:
            case 15:
            case 18:
            case 23:
            case 26:
            case 29:
            case 32:
            case 35:
            case 38:
            case 41:
            case 44:
                $colorError = true;
                $mensaje = "No puedes acceder manualmente.";
                break;
            case 4:
                $mensaje = "Categoría eliminada.";
                break;
            case 5:
                $colorError = true;
                $mensaje = "No se pudo eliminar la categoría.";
                break;
            case 7:
                $mensaje = "Categoría editada.";
                break;
            case 8:
                $colorError = true;
                $mensaje = "No se pudo editar la categoría.";
                break;
            case 10:
                $mensaje = "Marca creada.";
                break;
            case 11:
                $colorError = true;
                $mensaje = "No se pudo crear la marca.";
                break;
            case 13:
                $mensaje = "Marca eliminada.";
                break;
            case 14:
                $colorError = true;
                $mensaje = "No se puedo eliminar la marca.";
                break;
            case 16:
                $mensaje = "Marca editada.";
                break;
            case 17:
                $colorError = true;
                $mensaje = "No se puedo editar la marca.";
                break;
            case 19:
                $mensaje = "Orden completada.";
                break;
            case 20:
                $colorError = true;
                $mensaje = "La dirección y la orden se completo, pero no se pudo vaciar el carrito.";
                break;
            case 21:
                $colorError = true;
                $mensaje = "Se inserto la dirección, pero no se pudo insertar la orden.";
                break;
            case 22:
                $colorError = true;
                $mensaje = "Error en el sistema, no se pudo guardar la dirección.";
                break;
            case 24:
                $mensaje = "Producto creado.";
                break;
            case 25:
                $colorError = true;
                $mensaje = "No se pudo crear el producto.";
                break;
            case 27:
                $mensaje = "Producto eliminado.";
                break;
            case 28:
                $colorError = true;
                $mensaje = "No se puedo eliminar el producto.";
                break;
            case 30:
                $mensaje = "Producto editado.";
                break;
            case 31:
                $colorError = true;
                $mensaje = "No se pudo editar el producto.";
                break;
            case 33:
                $mensaje = "Subcategoría creada.";
                break;
            case 34:
                $colorError = true;
                $mensaje = "No se pudo crear la subcategoría.";
                break;
            case 36:
                $mensaje = "Subcategoría eliminada.";
                break;
            case 37:
                $colorError = true;
                $mensaje = "No se pudo eliminar la subcategoría.";
                break;
            case 39:
                $mensaje = "Subcategoría editada.";
                break;
            case 40:
                $colorError = true;
                $mensaje = "No se pudo editar la subcategoría.";
                break;
            case 42:
                $mensaje = "Datos editados.";
                break;
            case 43:
                $colorError = true;
                $mensaje = "No se pudo editar los datos.";
                break;
            case 45:
                $mensaje = "La factura se envió a su correo.";
            
        }
    }
?>