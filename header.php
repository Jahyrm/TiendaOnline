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
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                            <div class="container">
                                <a href="index.php" class="navbar-brand">Inicio </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuNavegacion" aria-expanded="false" aria-label="Alternar menú">
                                    <span class="navbar-toggle-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="menuNavegacion">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item dropdown mx-lg-1">
                                            <a href="" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
                                                Marcas
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="#navbarDropdown">
                                            <?php $marcas = json_decode( file_get_contents($env.'api/marca/read.php'), true );?>
                                            <?php foreach ($marcas["records"] as $marca){ ?>
                                                <a href="#" class="dropdown-item"><?php echo $marca['name'];?></a>
                                            <?php } ?>
                                            </div>
                                        </li>


                                        <li class="nav-item dropdown  mx-lg-1">
                                            <a href="" class="nav-link dropdown-toggle" id="navbarDropdown1" data-toggle="dropdown">
                                                Maquillaje
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="#navbarDropdown1">
                                                <a href="#" class="dropdown-item">Maquillaje 1</a>
                                                <a href="#" class="dropdown-item">Maquillaje 2</a>

                                            </div>
                                        </li>


                                        <li class="nav-item dropdown  mx-lg-1">
                                            <a href="" class="nav-link dropdown-toggle" id="navbarDropdown2" data-toggle="dropdown">
                                                Capilar
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="#navbarDropdown2">
                                                <a href="#" class="dropdown-item">ca 1</a>
                                                <a href="#" class="dropdown-item">ca 2</a>
                                            </div>
                                        </li>


                                        <li class="nav-item dropdown  mx-lg-1">
                                            <a href="" class="nav-link dropdown-toggle" id="navbarDropdown3" data-toggle="dropdown">
                                                Cuidado personal
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="#navbarDropdown3">
                                                <a href="#" class="dropdown-item">Cuidado 1</a>
                                                <a href="#" class="dropdown-item">Cuidado 2</a>
                                            </div>
                                        </li>


                                        <li class="nav-item  mx-lg-2">
                                            <a href="" class="nav-link">Otros</a>
                                        </li>
                                    </ul>
                                    <form action="" class="form-inline w-100" my-2 my-lg-0>
                                        <input type="text" class="form-control mr-sm-2" type="search" placeholder="¿Qué estás buscando?">
                                        <button class="btn btn-light my-2 my-sm-0" type="submit">Buscar</button>
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>