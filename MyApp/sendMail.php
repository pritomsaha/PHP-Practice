<?php 

	require("mailconfig.php");

	$to="bsse0604@iit.du.ac.bd";
    $subject  =   "Hello";
    $message  =   "hello <i>how are you.</i>";
    $name     =   "Pritom";
    $mailsend =   sendmail($to,$subject,$message,$name);
    if($mailsend==1){
    	echo '<h2>email sent.</h2>';
    }
    else{
    	echo '<h2>There are some issue.</h2>';
    }
?>