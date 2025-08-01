<?php

// Define some constants
define( "RECIPIENT_NAME", "Vida Silvestre NWC" );
define( "RECIPIENT_EMAIL", "info@vidasilvestre.napowildlifecenter.com" );


// Read the form values
$success = false;
$userName = isset( $_POST['username'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['username'] ) : "";
$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
$userMotivo = isset( $_POST['motivo'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['motivo'] ) : "";
$userComo = isset( $_POST['comoteenteraste'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['comoteenteraste'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// If all values exist, send the email
if ( $userName && $senderEmail && $userMotivo && $userComo && $message) { 
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $subject = $userMotivo;
  $headers = "From: " . $senderEmail . "\r\n";
  $headers .= "Reply-To: " . $senderEmail . "\r\n";
  $headers .= 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  $msgBody = "Nombre: ". $userName . "Email: ". $senderEmail . "Motivo: ". $userMotivo . "Como se enteró: ". $userComo . "Mensaje: " . $message . "";
  $success = mail( $recipient, $subject, $message, $headers );

  //Set Location After Successsfull Submission
  header('Location: ubicacion.php?message=Successfull');
}
else{
	//Set Location After Unsuccesssfull Submission
  header('Location: ubicacion.php?message=Failed');	
}

?>