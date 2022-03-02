<?php

foreach($_POST as $key => $value)
{

}

$array = array_values($_POST);
$name = $array[0];
$email_to = $array[1];
$reason = $array[2];
$message = $array[3];

$date = date("m/d/Y");

$email_response = "Thank you for reaching out to us ".$name.". Your ".$reason." was sucessfully submitted on ".$date.". We will resond to your ".$reason." as soon as possibe.";

$response_message = "This is a response email body for the customer";

function sendMail($name,$email_to,$reason,$message)
{
    mail("monesheim@monesheim.com", $reason, $message,"From: ".$email_to );
}

function confirmation($email_to,$email_response,$date)
{
    mail($email_to,"Confirmation Email", $email_response,"From: monesheim@monesheim.com");
    echo"A confirmation email has been sent to ".$email_to." on ".$date."<br>";
    echo $email_response;
}

sendMail($name,$email_to,$reason,$message);
confirmation($email_to,$email_response, $date);
?>