<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'ezebaravalle@gmail.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // $subject = trim($_POST["subject"]);
  // $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
  // $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  // $phone = trim($_POST["phone"]);
  // $message = trim($_POST["message"]);

  // // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  // /*
  // $contact->smtp = array(
  //   'host' => 'example.com',
  //   'username' => 'example',
  //   'password' => 'pass',
  //   'port' => '587'
  // );
  // */

  // $contact->add_message( $_POST['name'], 'From');
  // $contact->add_message( $_POST['email'], 'Email');
  // $contact->add_message( $_POST['message'], 'Message', 10);

  // echo $contact->send();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    #Reemplazar este correo por el correo electrónico del destinatario
    $mail_to = "ezebaravalle@gmail.com";
    
    # Envío de datos
    $subject = trim($_POST["subject"]);
    $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);
    
    if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($phone) OR empty($subject) OR empty($message)) {
        # Establecer un código de respuesta y salida.
        http_response_code(400);
        echo "Por favor completa el formulario y vuelve a intentarlo.";
        exit;
    }
    
    # Contenido del correo
    $content = "Nombres: $name\n";
    $content .= "E-mail: $email\n\n";
    $content .= "Telefono: $phone\n";
    $content .= "Mensaje:\n$message\n";

    # Encabezados de correo electrónico.
    $headers = "From: $name <$email>";

    # Envía el correo.
    $success = mail($mail_to, $subject, $content, $headers);
    if ($success) {
        # Establece un código de respuesta 200 (correcto).
        http_response_code(200);
        echo "¡Gracias! Tu mensaje ha sido enviado.";
    } else {
        # Establezce un código de respuesta 500 (error interno del servidor).
        http_response_code(500);
        echo "Oops! Algo salió mal, no pudimos enviar tu mensaje.";
    }

} else {
    # No es una solicitud POST, establezce un código de respuesta 403 (prohibido).
    http_response_code(403);
    echo "Hubo un problema con tu envío, intenta de nuevo.";
}



?>
