s<?php
    //enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include the Mail package
    require "Mail.php";

    // Fields from the HTML POST
    $customer_name = $_POST["name"];
    $customer_email = $_POST["email"];
    $customer_phone = $_POST["phone"];
    $requested_date = $_POST["date"];
    // $comments = $_POST["comments"];

    // Identify the mail server, username, password, and port
    $ateam_email = "ateamvaulting@gmail.com";
    $server   = "ssl://smtp.gmail.com";
    $username = "ateamvaulting@gmail.com";
    $password = "!QAZ2wsx#EDC4rfv";
    $port     = "465";

    // Set up the request subject and mail headers
    $req_subject = "Session Request: ".($customer_name)." - ".($requested_date);
    $req_headers = array(
        "From"    => $customer_email,
        "To"      => $ateam_email,
        "Reply-To" => $customer_email,
        "Subject" => $req_subject
    );

    // Setup request message to A-Team Vaulting with:
    // the users name, email and requested date
    $req_msg = "";
    $req_msg .= "A vaulter has requested a session!\n";
    $req_msg .= "Name: ".($customer_name)."\n";
    $req_msg .= "Email: ".($customer_email)."\n";
    $req_msg .= "Phone: ".($customer_phone)."\n";
    $req_msg .= "When: ".($requested_date)." 5:30pm \n";
    // $req_msg .= "Comments: ".($comments)."\n";

    // Set up the confirmation subject and mail headers
    $rep_subject = "Session Request Received - Not Yet Confirmed for ".($requested_date);
    $rep_headers = array(
        "From"    => $ateam_email,
        "To"      => $customer_email,
        "Subject" => $rep_subject
    );

    // Setup auto-reply message to customer
    $rep_msg = "";
    $rep_msg .= "YOUR SESSION IS NOT CONFIRMED.\n\nThank you for your session request!  We will get back to you shortly to confirm your request for ";
    $rep_msg .= ($requested_date)." at 5:30 pm.\n\n";
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
