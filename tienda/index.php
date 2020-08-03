<?php 
session_start();
include "../globalVars.php";

if (isset($_GET['c']) || isset($_GET['s'])) {
    if(isset($_GET['c'])) { $cid = $_GET['c']; }
    if(isset($_GET['s'])) { $sid = $_GET['s']; }

    if (isset($cid)) {
        if(isset($sid)) {
            $params = "?catid=".$cid."&subcatid=".$sid;
        } else {
            $params = "?catid=".$cid;
        }
    } else {
        if(isset($sid)) {
            $params = "?subcatid=".$sid;
        } else {
            header("Location: ../index.php");
            die();
        }
    }

    $url = $env.'api/product/filter.php'.$params;


    set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
        throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
    }, E_WARNING);
    try {
        $productos = json_decode( file_get_contents($url), true );
    } catch (Exception $e) {}
    restore_error_handler();

    
        if(isset($_COOKIE['logincookie'])) {
            if (!isset($_SESSION['Recuperado'])) {
                include 'logic/funciones.php';
                $id = dec_enc('decrypt', $_COOKIE['logincookie']);
                recuperarUser($id);
            }
        }

        $titulo = "Tienda | Zibá ¡es como tú!";
        $prof = "../";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
<?php include('../head.php') ?>
<link rel="stylesheet" href="../css/bootstrap-select.min.css">

    </head>
    <body>
<?php include('../header.php'); ?>

<main class="container">

    <div clas="col-12 pb-3">
    <br/>

<?php
if (isset($cid)) {
    foreach($categorias["records"] as $categoria) {
        if($categoria["id"]==$cid) {
            $nombreCat = $categoria["name"];
        }
    }
}
?>

    <center><h2>Tienda</h2></center>
    <br/><br/>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="card">
                <h5 class="card-header">Categorías</h5>
                <div class="card-body">
                    <div class="list-group">
<?php
foreach ($categorias["records"] as $categoria) { ?>
                    <a href="?c=<?php echo $categoria["id"]; ?>" class="list-group-item list-group-item-action"><?php echo $categoria["name"]; ?></a>
<?php } ?>
                    </div>
                </div>
            </div>
            <br/>



<?php if(!isset($sid)) { ?>
            <div class="card">
                <h5 class="card-header">Filtro</h5>
                <div class="card-body form-group">
                <form>
                <input id="catId" name="catId" type="hidden" value="<?php echo $cid; ?>">
                <select class="form-control selectpicker" data-live-search="true" id="sbid" name="sbid">
                    <option value="0">Selecciona una subcategoría</option>
<?php
        foreach ($categorias["records"] as $categoria) {
            if ($categoria["id"]==$cid) {
                foreach ($categoria["subcategories"] as $subcategoria) { ?>
                    <option value="<?php echo $subcategoria["id"]; ?>"><?php echo $subcategoria["name"]; ?></option>
<?php        
                }
            break;
            }
?>
<?php } ?>
                </select>
                </form>
                </div>
            </div>
<?php } ?>


        </div>
        <div class="col-9" id="productsLoader">
<?php
    $contador = 0;
    if(!empty($productos["records"])){
        for ($x=0; $x<count($productos["records"]); $x++) {
            if($contador==0) {
?>
            <div class="row">
<?php       } ?>
                <div class="col-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $productos["records"][$x]["image"];?>" alt="" style="height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $productos["records"][$x]["name"];?></h5>
                            <p class="card-text"><b>Precio:</b> <?php echo $productos["records"][$x]["price"];?></p>
                            <p class="card-text"><?php echo $productos["records"][$x]["description"];?></p>
                            <a href="../logic/cart/add.php?id=<?php echo $productos["records"][$x]["id"];?>"><button class="btn btn-dark mb-1" style="width: 100%;">Agregar al carrito</button></a>
                            <a href="../producto/?id=<?php echo $productos["records"][$x]["id"];?>"><button class="btn btn-dark" style="width: 100%;">Detalles del producto</button></a>
                        </div>
                    </div>
                </div>
<?php       $contador=$contador+1;
            if($contador==3 || $x==(count($productos["records"])-1)) { ?>
            </div>
<?php           $contador=0;
            }
        }
    } else { ?>
        <div class="row"><div class="col">No se encontraron productos.</div></div>
<?php
    }
?>
        </div>
    </div>
    <br/><br/>
</main>

<?php include('../footer.php');?>
    <script src="../js/bootstrap-select.min.js"></script>
<?php if(!isset($sid)) { ?> <script src="../logic/tiendaAjax.js"></script><?php }?>
    </body>
</html>
<?php
} else {
	header("Location: ../index.php");
}
?>