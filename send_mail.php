<?php
    //enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include the Mail package
    require "Mail.php";

    // Fields from the HTML POST
    $customer_name = $_POST["name"];
    $customer_email = $_POST["email"];
    $requested_date = $_POST["date"];
    $comments = $_POST["comments"];

    // Identify the mail server, username, password, and port
    $ateam_email = "ateamvaulting@gmail.com";
    $server   = "ssl://smtp.gmail.com";
    $username = $ateam_email;
    $password = "InserPasswordHere";
    $port     = "465";

    // Set up the request subject and mail headers
    $req_subject = "A-Team Reservation Request";
    $req_headers = array(
        "From"    => $ateam_email,
        "To"      => $ateam_email,
        "Subject" => $req_subject
    );

    // Setup request message to A-Team Vaulting with:
    // the users name, email and requested date
    $req_msg = "";
    $req_msg .= "A vaulter has requested a session!\n";
    $req_msg .= "Name: ".($customer_name)."\n";
    $req_msg .= "Email: ".($customer_email)."\n";
    $req_msg .= "Date: ".($requested_date)."\n";
    $req_msg .= "Comments: ".($comments)."\n";

    // Set up the confirmation subject and mail headers
    $rep_subject = "Confirmation of Your Request";
    $rep_headers = array(
        "From"    => $ateam_email,
        "To"      => $customer_email,
        "Subject" => $rep_subject
    );

    // Setup auto-reply message to customer
    $rep_msg = "";
    $rep_msg .= "Thank you for your session request!\n\n";
    $rep_msg .= "One of the A-Team coaches will contact you shortly to confirm the date, time and location.\n\n";
    $rep_msg .= "Thanks,\n";
    $rep_msg .= "A-Team Vaulting";
 
    // Configure the mailer mechanism
    $smtp = Mail::factory("smtp",
        array(
            "host"     => $server,
            "username" => $username,
            "password" => $password,
            "auth"     => true,
            "port"     => 465
        )
    );
 
    // Send the request message to Ateam Vaulting
    $req_mail = $smtp->send($ateam_email, $req_headers, $req_msg);
    if (PEAR::isError($req_mail)) die($req_mail->getMessage());
    
    // Send the auto-reply message to the customer
    $rep_mail = $smtp->send($customer_email, $rep_headers, $rep_msg);
    if (PEAR::isError($rep_mail)) die($rep_mail->getMessage());

?>
