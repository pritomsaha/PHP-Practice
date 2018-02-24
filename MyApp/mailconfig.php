<?php require_once( '../PHPMailer/PHPMailerAutoload.php');

function sendmail($to,$subject,$message,$name){

                  $mail             = new PHPMailer();
                  $body             = $message;
                  $mail->IsSMTP();
                  $mail->SMTPAuth   = true;
                  $mail->Host       = "smtp.gmail.com";
                  $mail->Port       = 587;
                  $mail->Username   = "auser062013";
                  $mail->Password   = "iitdu123";
                  $mail->SMTPSecure = 'tls';
                  $mail->SetFrom('auser062013@gmail.com', 'Admin of Budget Planner');
                  /*$mail->AddReplyTo("youraccount@gmail.com","Your name");*/
                  $mail->Subject    = $subject;
                  //$mail->AltBody    = "Any message.";
                  $mail->MsgHTML($body);
                  $address = $to;
                  $mail->AddAddress($address, $name);
                  
                  if(!$mail->Send())return 0;
                  else return 1;
}

?>