
    <footer class="footer-container">
        <div class="bg-dark text-white pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <p style="text-align: left;">Conéctate con nosotros en las redes sociales!</p>
                    </div>
                    <div class="col-lg-1">
                        <a style="text-align: left;" href="https://www.facebook.com/ZibaBelleza" target="_blank"><i
                            class="fab fa-facebook-square"></i></a>        
                    </div>    
                    <div class="col-lg-1">
                        <a style="text-align: left;" href="https://instagram.com/zibabelleza?igshid=6802q6h6htzp" target="_blank"><i
                            class="fab fa-instagram-square"></i></a>
                    </div>    
                    <div class="col-lg-1">
                        <a style="text-align: left;" href="https://instagram.com/zibabelleza?igshid=6802q6h6htzp" target="_blank"><i
                            class="fab fa-whatsapp-square"></i></a>
                    </div>    
                </div>
            </div>
        </div>
        <div class="container pt-4">
            <div class="row pb-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <h4>Empresa</h4>
                    <div style="display: flex; flex-direction: column;">
                        <a style="text-align: left;" href="<?php if (isset($prof)) { echo $prof; } ?>acercaNosotros.php">Acerca de nosotros</a>
                        <a style="text-align: left;" href="contacto.php">Contactos</a>
                    </div>
                </div>
                <hr>
                <div class="col-12 col-md-6 col-lg-3">
                    <h4>Información</h4>
                    <div style="display: flex; flex-direction: column;">
                        <a style="text-align: left;" href="<?php if (isset($prof)) { echo $prof; } ?>envios.php">Envíos y devoluciones</a>
                        <a style="text-align: left;" href="<?php if (isset($prof)) { echo $prof; } ?>formasPago.php">Formas de pago</a>
                        <a style="text-align: left;" href="<?php if (isset($prof)) { echo $prof; } ?>index.php">Promociones vigentes</a>

                    </div>
                </div>
                <hr>
                <div class="col-12 col-sm-6 col-lg-3">
                    <h4>Legal</h4>
                    <div style="display: flex; flex-direction: column;">
                        <a style="text-align: left;" href="<?php if (isset($prof)) { echo $prof; } ?>terminosYcondiciones.php">Términos y condiciones</a>
                        <a style="text-align: left;" href="<?php if (isset($prof)) { echo $prof; } ?>politicaPrivacidad.php">Política de privacidad</a>
                    </div>
                </div>
                <hr>
                <div class="col-12 col-sm-6 col-lg-3">
                    <h4>Síguenos en </h4>
                    <div style="display: flex; flex-direction: column;">
                        <a style="text-align: left;" href="https://www.facebook.com/ZibaBelleza" target="_blank"><i
                                class="fab fa-facebook-square"></i> Facebook</a>
                        <a style="text-align: left;" href="https://instagram.com/zibabelleza?igshid=6802q6h6htzp"
                            target="_blank"><i class="fab fa-instagram-square"></i> Instagram</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?php if (isset($prof)) { echo $prof; } ?>js/jquery-3.5.1.min.js"></script>
    <script src="<?php if (isset($prof)) { echo $prof; } ?>js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5b9c980490.js" crossorigin="anonymous"></script>