<?php
require_once "vendor/autoload.php"; //PHPMailer Object 

// include_once "resources/pdf.php";
// include_once "controller.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require('fpdf186/fpdf.php');
//$pdf=new FPDF();

//instancio un objeto de la clase PHPMailer
$mail = new PHPMailer(); // defaults to using php "mail()"

//defino el cuerpo del mensaje en una variable $body
		//se trae el contenido de un archivo de texto
		//también podríamos hacer $body="contenido...";
		// $body = file_get_contents('contenido.html');
		$body = "<h1>hola mundo</h1>";
		//Esta línea la he tenido que comentar
		//porque si la pongo me deja el $body vacío
		// $body = preg_replace('/[]/i','',$body);

		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       ='smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		//si la autentificacion es false no hace faltael user ni pass
		$mail->Username   = 'victorgsp94@gmail.com';                     // SMTP username
		$mail->Password   = 'secret';                               // SMTP password
		$mail->SMTPSecure = 'SSL';//PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS 		`PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = 587;  

		//defino el email y nombre del remitente del mensaje
		$mail->SetFrom('victorgsp94@gmail.com', 'Nombre completo');

		//defino la dirección de email de "reply", a la que responder los mensajes
		//Obs: es bueno dejar la misma dirección que el From, para no caer en spam
		$mail->AddReplyTo("victorgsp94@gmail.com","Nombre Completo");
		//Defino la dirección de correo a la que se envía el mensaje
		$address = "vgsp1994@gmail.com";
		//la añado a la clase, indicando el nombre de la persona destinatario
		$mail->AddAddress($address, "Nombre completo");

		//Añado un asunto al mensaje
		$mail->Subject = "Envío de email con PHPMailer en PHP";

		//Puedo definir un cuerpo alternativo del mensaje, que contenga solo texto
		$mail->AltBody = "Cuerpo alternativo del mensaje";

		//inserto el texto del mensaje en formato HTML
		$mail->MsgHTML($body);

		//print_r($mail);

		// try {
		// 	echo "***";
		// 	$mail->Send();
		// 	echo "***";
		// } catch (Exception $e) {
		// 	echo "MSJ ".$e->message();
		// }
		//asigno un archivo adjunto al mensaje
		//$mail->AddAttachment("ruta/archivo_adjunto.gif");

		//envío el mensaje, comprobando si se envió correctamente
		if(!$mail->Send()) {
			echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
		} else {
			echo "Mensaje enviado!!";
		}

/*
class citaPdfController{ 

	public function __construct(){

		require_once "models/citaModel.php";
		$this->mode = new cita_model();
		$this->alm = new cita_model();
		

	}
	public function pdf(){
		/*
		$this->alm = $this->mode->Consultar("pdfCita", $_REQUEST['id']);
		//$this->alm->nombres='';
		$html1='
		<body>


		</body>';

		$html = '
		<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<br>
		<br>
		<br>
		<br>
		Ansamar Centro Medico<br>
		<p align="center">Cita odontologica: </p>
		<br><hr>
		<br>
		<h1><b>Paciente:</b></h1>
		<br>
		<br>
		<label><b>Cedula:</b> '.$this->alm->cedula.'</label>
		<br>
		<br>
		<label><b>Nombre:</b> '.$this->alm->nombres.' '.$this->alm->apellidos.'</label>
		<br>
		<br>
		<label><b>Consultorio:</b> '.$this->alm->consultorio.'</label>
		<br>
		<br>
		<label><b>Turno:</b>'.$this->alm->turno.'</label>
		<br>
		<br>
		<label><b>Odontologo:</b> '.$this->alm->nombreO.' '.$this->alm->apellidosO.'</label>
		<br>
		<br>
		<label><b>Fecha de cita:</b> '.date("d-m-Y",strtotime($this->alm->fecha)).'</label>
		';
		$pdf=new PDF_HTML();
		$pdf->AddPage();
		$pdf->SetFont('Arial');
		//$css=file_get_contents('controllers/style.css');
		//$pdf->WriteHTML($css,1);
		$pdf->Image('resources/logo.png', 10, 10, -600);
		$pdf->WriteHTML($html);
		$pdf->AliasNbPages();
		$pdf->Output();
		*/

		// haciendo referencia a la clase phpmailer
		/*require 'resources/PHPMailer/class.phpmailer.php';
		 
		$mail = new PHPMailer();
		$mail->From = 'victorgsp94@gmail.com';
		$mail->FromName = 'Nombre remitente';
		$mail->Subject = 'Allegato in PDF';
		$mail->Body = 'Se adjunta el reporte en pdf';
		$mail->AddAddress('victorgsp94@gmail.com');
		 
		// definiendo el adjunto 
		$mail->AddStringAttachment($pdf, 'doc.pdf', 'base64', 'application/pdf');
		// enviando
		$mail->Send();*/


		



		

		




//	}// FIN FUCTION PDF
//}  // FIN DE LA CLASE

		/*$pdf=new PDF_HTML();
		$pdf->AddPage();
		$pdf->SetFont('Arial');
		$pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');
		$pdf->Output();
*/

/*$pdf->WriteHTML("<h1>PRUEBA</h1>");
$pdf->output("miarchivopdf","I");
$pdf->AddPage();

// config document
$pdf->SetTitle('Generar archivos PDF con PHP');
$pdf->SetAuthor('Kodetop');
$pdf->SetCreator('FPDF Maker');

// add title
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(0, 10, 'Generar archivos PDF con PHP', 0, 1);
$pdf->Ln();

// add text
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 7, utf8_decode('Los archivos PDF se utilizan ampliamente en documentos y reportes que necesitan mantener el diseño y contenido (imágenes, tipos de letra, colores, etc), por ello vamos a aprender a crear archivos PDF utilizando PHP.'), 0, 1);
$pdf->Ln();
$pdf->MultiCell(0, 7, utf8_decode('FPDF es una clase PHP que permite la generación de archivos PDF de forma sencilla y sin necesidad de instalar librerías adicionales, cuenta con métodos bien documentados que facilitan su uso.'), 0, 1);
$pdf->Ln();
$pdf->MultiCell(0, 7, utf8_decode('Antes de comenzar lo primero es descargar FPDF e incluir los archivos necesarios en nuestro proyecto.'), 0, 1);
$pdf->Ln();

// add image
$pdf->Image('assets/cita.png', null, null, 180);

// output file
$pdf->Output();*/
?>

<?php
/*require('fpdf186/fpdf.php');
require_once "models/citaModel.php";
$mode = new cita_model();
$alm = new cita_model();
//$this->mode = new cita_model();
//$this->alm = $this->mode->Consultar("cargarInformacionCita", $_REQUEST['id']);
class PDF extends FPDF
{
		
			
			//$this->pdf = new FPDF();
		
// Cabecera de página
function Header()
{

    // Logo
    $this->Image('assets/cita.png',9,7,20);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    $this->Ln(20);
    // Título
    $this->Cell(60,10,'Cita para el dia',1,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->MultiCell(0, 7, utf8_decode('Los archivos PDF se utilizan ampliamente en documentos y reportes que necesitan mantener el diseño y contenido (imágenes, tipos de letra, colores, etc), por ello vamos a aprender a crear archivos PDF utilizando PHP.'), 0, 1);

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Output();*/
?>