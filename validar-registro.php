<?php
//======================================================================
// PROCESAR FORMULARIO 
//======================================================================
// Comprobamos si nos llega los datos por POST
if (isset($_POST['registrarse'])) {
    //-----------------------------------------------------
    // Funciones Para Validar
    //-----------------------------------------------------

    /**
     * Método que valida si un texto no esta vacío
     * @param {string} - Texto a validar
     * @return {boolean}
     */
    function validar_requerido(string $texto): bool
    {
        return !(trim($texto) == '');
    }

    /**
     * Método que valida si es un número entero 
     * @param {string} - Número a validar
     * @return {bool}
     */
    function validar_entero(string $numero): bool
    {
        return (filter_var($numero, FILTER_VALIDATE_INT) === FALSE) ? False : True;
    }

    /**
     * Método que valida si el texto tiene un formato válido de E-Mail
     * @param {string} - Email
     * @return {bool}
     */
    function validar_email(string $texto): bool
    {
        return (filter_var($texto, FILTER_VALIDATE_EMAIL) === FALSE) ? False : True;
    }

    //-----------------------------------------------------
    // Variables
    //-----------------------------------------------------
    $errores = [];
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null; 
    $pass = isset($_POST['contraseña']) ? $_POST['contraseña'] : null; 
    $email = isset($_POST['correo']) ? $_POST['correo'] : null;

    //-----------------------------------------------------
    // Validaciones
    //-----------------------------------------------------
    // Nombre
    if (!validar_requerido($nombre)) {
        $errores[] = 'El campo Nombre es obligatorio.';
    }
    // Apellido
    if (!validar_requerido($apellido)) {
        $errores[] = 'El campo Apellido es obligatorio.';
    }
    // Usuario
    if (!validar_requerido($usuario)) {
        $errores[] = 'El campo Usuario es obligatorio.';
    }
    // Contraseña
    if (!validar_requerido($pass)) {
        $errores[] = 'El campo Constraseña es obligatorio.';
    }
    // Email
    if (!validar_email($email)) {
        $errores[] = 'El campo de Email tiene un formato no válido.';
    }
}
?>
<!-- Mostramos errores por HTML -->
<?php if (isset($errores)) : ?>
    <ul class="errores">
        <?php
        foreach ($errores as $error) {
            echo '<li>' . $error . '</li>';
        }
        ?>
    </ul>
<?php endif; ?>


