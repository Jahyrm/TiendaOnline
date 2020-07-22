<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    
    <title>Mi cuenta</title>
</head>

<body class>
    <?php include('header1.php'); ?>
    <main class="container">
        <div class="row">
            <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>AAAA</td>
                    <td>BBBB</td>
                    <td>CCCC</td>
                    <td>
                        <button class="btn btn-dark mb-1" style="width: 100%;">Quitar</button>
                    </td>
                    </tr>
                    <tr>
                </tbody>
            </table>
            </div>
        </div>
        
    </main>

    <?php include('footer.php'); ?>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5b9c980490.js" crossorigin="anonymous"></script>
</body>

</html>