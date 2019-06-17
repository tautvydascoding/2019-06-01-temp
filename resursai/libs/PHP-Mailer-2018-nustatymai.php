 

https://myaccount.google.com/lesssecureapps

<?php
// print_r( $_POST );
$klientoVardas = $_POST['name'];
$klientoKlausimas = $_POST['klausimas'];
$klientoPastas = $_POST['elpastas'];
// echo "  $klientoVardas  $klientoPavarde  <hr /> ";
// echo "  $klientoAntraste  <hr /> $klientoKlausimas   ";
// echo "  <hr /> $klientoPastas   ";

require_once ("libs/PHPMailer-master/PHPMailerAutoload.php");
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    // papildomi PhpMailer nustatymia, jeigu neveikia su standartiniais
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );
    $mail->Host = 'tls://smtp.gmail.com:587';
    $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                      // TCP port to connect to
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'testascoding@gmail.com';                 // SMTP username
    $mail->Password = 'slaptazodis';                          // SMTP username
    //Recipients
    $mail->setFrom( 'testascoding@gmail.com' ,  $klientoVardas);
    $mail->addReplyTo( $klientoPastas, $klientoVardas);     // Add a recipient
    $mail->addAddress( 'testascoding@gmail.com', 'Puslapiu kurejai');
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Klausimas';
    $mail->Body    = " <b>Klienatas klausia:</b>   $klientoKlausimas" ;
    $mail->AltBody = " Klieantas klausia: $klientoPastas";
    $mail->send();
    echo '<div class="bg-info"> ZINUTE ISSIUSTA SEKMINGAI     </div>';
} catch (Exception $e) {
    echo '<div class="bg-danger"> neveikia     </div>' . $mail->ErrorInfo;
}
