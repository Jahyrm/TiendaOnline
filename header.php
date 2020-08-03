<header class="fixed-top">
        <div class="heade">
            <div class="logo">
                <img src="<?php if (isset($prof)) { echo $prof; } ?>Logo.jpeg" alt="" style="height: 60px;">
            </div>
            <div class="cuenta">

                <?php 
                if (isset($_SESSION['UID'])) { ?>
                    <a href="<?php if (isset($prof)) { echo $prof; } ?>cuenta-usuario.php">Mi Cuenta</a>
                    <a href="<?php if (isset($prof)) { echo $prof; } ?>logout.php">Cerrar sesión</a>
<?php
$itemsTotales = 0;
set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
    throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
}, E_WARNING);
try {
    $prodsInCart = json_decode( file_get_contents($env.'api/carrito/read.php?id='.$_SESSION["UID"]), true );
    foreach ($prodsInCart["records"] as $productCart){
        $itemsTotales = $itemsTotales + $productCart["cantidad"];
    }
?>
                    <a href="<?php if (isset($prof)) { echo $prof; } ?>carrito.php">Carrito de compras (<?php echo $itemsTotales; ?>)</a>
<?php } catch (Exception $e) { ?>
                    <a href="<?php if (isset($prof)) { echo $prof; } ?>carrito.php">Carrito de compras (0)</a>
<?php } 
restore_error_handler();
?>
                    
                <?php } else { ?>
                    <a href="<?php if (isset($prof)) { echo $prof; } ?>acceder.php">Acceder</a>
                    <a href="<?php if (isset($prof)) { echo $prof; } ?>registro.php">Registrarse</a>
                <?php }
                ?>
            </div>
        </div>
        
        <div style="background-color:#263238">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
                            <div class="container container-fluid">
                                <div class="navbar-header">
                                    <a href="<?php if (isset($prof)) { echo $prof; } ?>index.php" class="navbar-brand">Ziba</a>
                                </div>

                                <div class="collapse navbar-collapse" id="menuNavegacion">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="active nav-item mx-lg-1"><a class="nav-link" href="<?php if (isset($prof)) { echo $prof; } ?>index.php">Inicio</a></li>
                                        <li class="nav-item mx-lg-1"><a href="<?php if (isset($prof)) { echo $prof; } ?>marcas/" class="nav-link">Marcas</a></li>

<?php $categorias = json_decode( file_get_contents($env.'api/category/readAll.php'), true );
foreach ($categorias["records"] as $categoria) {
    if(!empty($categoria["subcategories"])) { ?>
                                        <li class="nav-item dropdown mx-lg-1">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style = "text-transform:capitalize;"><?php echo ucfirst(strtolower($categoria["name"])); ?></a>
                                            <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
<?php foreach($categoria["subcategories"] as $scItm) { ?>

                                                <li><a href="<?php if (isset($prof)) { echo $prof; } ?>tienda/?c=<?php echo $categoria["id"]; ?>&s=<?php echo $scItm["id"]; ?>" class="dropdown-item"><?php echo $scItm["name"]; ?></a></li>
<?php } ?>
                                            </ul>
                                        </li>
<?php
    } else { ?>
                                        <li class="nav-item mx-lg-1"><a href="<?php if (isset($prof)) { echo $prof; } ?>tienda/?c=<?php echo $categoria["id"]; ?>" class="nav-link"><?php echo $categoria["name"]; ?></a></li>
<?php
    }
?>
<?php } ?>
                                    </ul>
                                    <div class="text-right">
                                    <form action="<?php if (isset($prof)) { echo $prof; } ?>search.php" class="form-inline w-100" method="get">
                                        <input class="form-control mr-sm-2" type="search" name="s" id="s" placeholder="¿Qué estás buscando?">
                                        <button class="btn btn-light my-2 my-sm-0" type="submit">Buscar</button>
                                    </form>
                                    <div>
                                </div>
                            </div>
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
    </header>