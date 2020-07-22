<div style="display: none;">
<?php
    $data = array(
        'usernameOrEmail' => $_POST['correo'],
        'password' => $_POST['password']
    );
    $payload = json_encode($data);  
    // Prepare new cURL resource
    $ch = curl_init('http://localhost:5000/api/auth/signin');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);   
    // Set HTTP Header for POST request 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload))
    );    
    // Submit the POST request
    $result = curl_exec($ch);
    $lista = json_decode($result); 
    $token ="";
    $tipo="";
    $nombre2 = "";
    $contraseña="";
    $rol="";
    $array2[] = "";

    foreach ($lista as $tokenI){
    $nombre = $tokenI;
    $array2[] = $tokenI;
    
    }
    // Close cURL session handle
    curl_close($ch);
    
    ?>

</div>
<header class="fixed-top">
        <div class="heade">
            <div class="logo">
                <img src="Logo.jpeg" alt="" style="height: 60px;">
            </div>
            <div class="cuenta">
                <?php 
                if(strlen($array2[1]) > 50){?>
                    <a href="miCuenta.php"><?php  echo($array2[3]);?></a>
                    <a href="miCuenta.php">Cerrar sesión</a>
                    
                <?php } 
                else{?>
                    <a href="miCuenta.php">Mi cuenta</a>
                <?php }
                ?>
                
                <a href="">Carrito de compras (0) </a>
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
                                            <?php $lista = json_decode( file_get_contents('https://zibawebfinal.herokuapp.com/api/marcas/marcas'), true );?>
                                            <?php foreach ($lista as $marca){ ?>
                                                <a href="#" class="dropdown-item"><?php echo $marca['nombre'];?></a>
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
