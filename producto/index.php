<?php 
session_start();
include "../globalVars.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $product = json_decode( file_get_contents($env.'api/product/read_one.php?id='.$id), true );
    
    if(!empty($product["name"])) {
    // if datos.
        if(isset($_COOKIE['logincookie'])) {
            if (!isset($_SESSION['Recuperado'])) {
                include 'logic/funciones.php';
                $id = dec_enc('decrypt', $_COOKIE['logincookie']);
                recuperarUser($id);
            }
        }

        $titulo = $product["name"]." | Zibá ¡es como tú!";
        $prof = "../"
?>
<!DOCTYPE html>
    <html lang="es">
        <head>
<?php include('../head.php') ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        </head>
        <body>
<?php include('../header.php'); ?>
<br/>
            <main class="container">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <center><img style="width: 100%; height: auto;" src="<?php echo $product["image"]; ?>" /></center>
                            </div>
                            <div class="col">
                                <h1 class="product_title"><?php echo $product["name"]; ?></h1>
                                <p class="price">$ <?php echo $product["price"]; ?></p>
                                <div class="row">
                                    <div class="col">
                                        <p class="pdesc"><?php echo $product["description"]; ?></p>
                                    </div>
                                </div>
                                <p class="<?php if($product["stock"]==0){echo "out"; } else {echo "in"; } ?>-stock"><?php echo $product["stock"]; ?> en stock</p>
                                <form class="cart form-inline" action="../logic/cart/add.php" method="get">
                                <input type="hidden" name="id" value="<?php echo $product["id"]; ?>" />
                                    <div class="form-group">
                                        <label class="text-height" for="cantidad">Cantidad: </label>
                                        <input class="cantidad" type="number" step="1" min="1" max="<?php echo $product["stock"]; ?>" name="cantidad" value="1" pattern="[0-9]*" placeholder="" inputmode="numeric">
                                    </div>
                                    <button type="submit" class="btn btn-dark btn-primary">Agregar al carrito</button>
                                </form>
                                <br/>
                                <div class="product_meta">
                                    <span class="pm_enfasis">Marca: <a href="#" class="rela" ><span class="pm_desc"><?php echo $product["marca"]; ?></span></a></span><br/><br/>
                                    <span class="pm_enfasis">Categoría: <a href="#" class="rela"><span class="pm_desc"><?php echo $product["categoria"]; ?></span></a></span><br/><br/>
                                    <span class="pm_enfasis">Subcategoría: <a href="#" class="rela"><span class="pm_desc"><?php echo $product["subcategoria"]; ?></span></a></span>
                                </div>
                            </div>
                        </div>
<?php
$relacionados = json_decode( file_get_contents($env.'api/product/filter.php?subcatid='.$product["id_subcategoria"]), true );
if (!empty($relacionados["records"])){ ?>
                        <br/><br/>
                        <div class="row">
                            <div class="col">
                                <h2>Productos Relacionados</h2>
                            </div>  
                        </div>

                        <br/>
                        <div class="row">
<?php 
foreach ($relacionados["records"] as $relacionado){
    if($relacionado["id"]!=$product["id"]) {
?>

                            <div class="col-3">
                                <div class="card mx-auto">
                                    <img class="card-img-top" src=<?php echo $relacionado['image'];?> alt="" style="height: 250px;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $relacionado['name'];?></h5>
                                        <h5 class="card-title">Precio $<?php echo $relacionado['price'];?></h5>
                                        <p class="card-text"><?php echo $relacionado['description'];?></p>
                                        <a href="../logic/cart/add.php?id=<?php echo $relacionado['id']; ?>"><button class="btn btn-dark mb-1" style="width: 100%;">Agregar al carrito</button></a>
                                        <a href="index.php?id=<?php echo $relacionado['id']; ?>"><button class="btn btn-dark" style="width: 100%;">Detalles del producto</button></a>
                                    </div>
                                </div>
                            </div>
<?php 
    }
} 
?>
                        </div>
<?php } ?>
                    </div>
                </div>
            </main>

            <br/><br/>

<?php include('../footer.php'); ?>
        </body>
    </html>
<?php
    } else {
        header("Location: ../index.php");
    }
} else {
	header("Location: ../index.php");
}
?>