<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
include "../globalVars.php";

if (isset($_GET['id']) && isset($_SESSION["UID"])) {
    $id = $_GET['id'];
    $userOrder = json_decode( file_get_contents($env.'api/orden/read.php?by=orden&id='.$_GET["id"]), true );
    
    if(!empty($userOrder["records"])) {
        if ($_SESSION["UID"]==$userOrder["records"][0]["user"]["id"]) {

            require '../phpmailer/src/Exception.php';
            require '../phpmailer/src/PHPMailer.php';
            require '../phpmailer/src/SMTP.php';

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            ob_start();
            error_reporting(E_ALL & ~E_NOTICE);
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
        
            require_once("../tcpdf/tcpdf.php");
            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $obj_pdf->SetCreator(PDF_CREATOR);
            $obj_pdf->SetTitle("Factura");
            $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
            $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $obj_pdf->SetDefaultMonospacedFont('helvetica');
            $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
            $obj_pdf->setPrintHeader(false);
            $obj_pdf->setPrintFooter(false);
            $obj_pdf->SetAutoPageBreak(TRUE, 10);
            $obj_pdf->SetFont('helvetica', '', 12);
        
            $content = '';
        
            $content .= '
            <div>
                <div style="
                border-bottom: 15px solid #F81D2D;
                border-top: 15px solid #1E1F23;
                margin-top: 30px;
                margin-bottom: 30px;
                box-shadow: 0 1px 21px #808080;
                font-size: 18px;">
                    <table>
                        <tbody>
                            <tr>
                            <td><br><br/><br>
                            <img src="https://zibareal.herokuapp.com/Logo.jpeg" />
                            </td>
                            <td style="font-size: 13px !important; text-align: right;">
                            <h4 style="color: #F81D2D;"><strong>'.$nombreEmpresa.'</strong></h4>
                            <p>'.$direccionEmpresa.'</p>
                            <p>'.$telefonoEmpresa.'</p>
                            <p>'.$correoEmpresa.'</p>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <div style="text-align: center;">
                            <h2>Factura</h2>
                            <h5>00000'.$userOrder["records"][0]["id"].'</h5>
                        </div>
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;"><h5>Descripción</h5></th>
                                        <th style="width: 20%;"><h5>Precio</h5></th>
                                        <th style="width: 20%;"><h5>Cantidad</h5></th>
                                        <th style="width: 20%;"><h5>Subtotal</h5></th>
                                    </tr>
                                </thead>
                                <tbody>';
        
        $subtotal = 0;
        foreach ($userOrder["records"][0]["productos"] as $producto) { 
            $subtotal = $subtotal + $producto["price"];
        
                    $content.= '
                            <tr style="font-size: 8px !important;">
                                <td style="width: 40%;">'.$producto["name"].'</td>
                                <td style="width: 20%;"><i class="fa fa-usd" aria-hidden="true"></i> $'.$producto["price"].' </td>
                                <td style="width: 20%;">'.$producto["cant"].'</td>
                                <td style="width: 20%;"><i class="fa fa-usd" aria-hidden="true"></i> $'.($producto["price"]*$producto["cant"]).' </td>
                            </tr>';
        }
            $content .= '
                            <tr style="font-size: 13px;">
                            <td></td>
                            <td></td>
                            <td style="text-align: right;">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
            ';
        
        
        if(!empty($userOrder["records"][0]["descuento"])) {
                $content .= '
                <p>
                    <strong>Descuento: </strong>
                </p>';
         } 
        if(!empty($userOrder["records"][0]["iva"])) {
                $content .= '
                <p>
                    <strong>Iva: </strong>
                </p>';
        }
        
            $content .= '
            </td>
            <td>
            <p>
                <i class="fa fa-usd" aria-hidden="true"></i>$ '.$subtotal.'
            </p>
            ';
        
        
        
        if(!empty($userOrder["records"][0]["descuento"])) {
                $content .= '
                <p>
                <i class="fa fa-usd" aria-hidden="true"></i>$ '.($userOrder["records"][0]["descuento"]).'
                </p>';
         } 
        if(!empty($userOrder["records"][0]["iva"])) {
            $content .= '
            <p>
            <i class="fa fa-usd" aria-hidden="true"></i>$ '.($userOrder["records"][0]["iva"]).'
            </p>';
        }
        
        
        $content .= '
        </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="font-size: 14px; text-align: right;"><h4 style="color: #F81D2D;"><strong>Total:</strong></h4></td>
            <td style="font-size: 14px; text-align: left;"><h4 style="color: #F81D2D;">  $ '.$userOrder["records"][0]["total"].'</h4></td>
        </tr>
        ';
        
        $content .= '
                            </tbody>
                        </table>
                    </div>';
        $partesFecha = explode("-", $userOrder["records"][0]["fecha"]);
        $mes = intToMes($partesFecha[1]);
        $content .= '
                    <div style="font-size: 10px;">
                        <div class="col-md-12">
                            <p><b>Fecha :</b> '.$partesFecha[2].' de '.$mes.' del '.$partesFecha[0].'</p>
                            <p><img style="width: 75px; height: 50px;" src="https://zibareal.herokuapp.com/img/barcode.png" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        ';
        
            $obj_pdf->AddPage();
            $obj_pdf->writeHTML($content);
            $nombre = 'factura-00'.$userOrder["records"][0]["id"].'.pdf';
            $attachment = $obj_pdf->Output($nombre, 'S');
            //$fileatt = $pdf->Output($nombre, 'E');

            //$data = chunk_split($fileatt);


            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'wwecuador.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'smite.mail@wwecuador.com';                     // SMTP username
                $mail->Password   = 'S58E{-sD+gix';                               // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('smite.mail@wwecuador.com', 'Ziba Web');
                $mail->addAddress($userOrder["records"][0]["user"]["email"], $userOrder["records"][0]["user"]["nombre"]." ".$userOrder["records"][0]["user"]["apellido"]);     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo('smite.mail@wwecuador.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');
            
                // Attachments
                $mail->AddStringAttachment($attachment, $nombre, 'base64', 'application/pdf');
                //$mail->addAttachment();    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Factura';
                $mail->Body    = $content;
                $mail->AltBody = 'Le enviamos su factura solicitada. | Ziba';
            
                $mail->send();
                ob_end_clean();
                echo json_encode(array("message" => "Email enviado."));
                header("Location: ../cuenta-usuario.php?m=45");
            } catch (Exception $e) {
                echo json_encode(array("message" => "No se pudo enviar el email."));
            }
?>
<?php 
        } else {
            header("Location: ../cuenta-usuario.php");
        }
    } else {
        header("Location: ../cuenta-usuario.php");
    }
} else {
    header("Location: ../index.php");
}
?>