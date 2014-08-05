<?php


// Fields from the HTML POST
$user_name = $_POST["name"];
$user_email = $_POST["email"];
$requested_date = $_POST["date"];
$comments = $_POST["comments"];

// Message Variables
$ateam_email = "ateamvaulting@gmail.com";
$request_subject = "A-Team Reservation Request";
$confirmation_subject = "Confirmation of Your Request";

// Email header Variable
$headers = 'From: '.$ateam_email."\r\n".
'Reply-To: '.$ateam_email."\r\n";

// Message to send to A-Team Vaulting with:
// the users name, email and requested date
$request_msg = "";
$request_msg .= "A vaulter has requested a session!\n";
$request_msg .= "Name: ".($user_name)."\n";
$request_msg .= "Email: ".($user_email)."\n";
$request_msg .= "Date: ".($requested_date)."\n";
$request_msg .= "Comments: ".($comments)."\n";

// Message auto reply message sent to the user
$reply_msg = ""; 
$reply_msg .= "Thank you for your session request!\n\n"; 
$reply_msg .= "One of the A-Team coaches will contact you shorty to confirm the date, time and location.\n\n";
$reply_msg .= "Thanks,\n";
$reply_msg .= "A-Team Vaulting";

// Use wordwrap() if lines are longer than 70 characters
$request_msg = wordwrap($request_msg,70);
$reply_msg = wordwrap($reply_msg,70);

// Send email to A-Team Vaulting
mail( $ateam_email, $request_subject, $request_msg, $headers );

// Send thank you email to user
mail( $user_email, $confirmation_subject, $reply_msg, $headers );

?>
