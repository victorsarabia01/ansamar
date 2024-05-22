<?php
include_once "resources/pdf.php";
include_once "controller.php";
//require('fpdf186/fpdf.php');
//$pdf=new FPDF();
class citaPdfController{

	public function __construct(){
			
			require_once "models/citaModel.php";
			$this->mode = new cita_model();
			$this->alm = new cita_model();
			
		}
	public function pdf(){
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
			
			<br>
			<b><p align="center">Cita odontologica: </p></b>
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
		$pdf->Image('img/ansamarLogox.jpg', 10, 10, -1200);
		//$pdf->Image('resources/logo.jpg', 10, 10, -600);
		$pdf->WriteHTML($html);
		$pdf->AliasNbPages();
		$pdf->Output();


		// haciendo referencia a la clase phpmailer
		require 'resources/PHPMailer/class.phpmailer.php';
		 
		$mail = new PHPMailer();
		$mail->From = 'victorgsp94@gmail.com';
		$mail->FromName = 'Nombre remitente';
		$mail->Subject = 'Allegato in PDF';
		$mail->Body = 'Se adjunta el reporte en pdf';
		$mail->AddAddress('victorgsp94@gmail.com');
		 
		// definiendo el adjunto 
		$mail->AddStringAttachment($pdf, 'doc.pdf', 'base64', 'application/pdf');
		// enviando
		$mail->Send();

	}
}

		
?>

