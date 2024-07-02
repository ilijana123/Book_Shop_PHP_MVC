<?php
$to='nikola.petkovski01@gmail.com';
$subject='Hello!';


$message='
<html>
<head>
    <title>Review Request Reminder</title>
<head>
<html>';
$result=mail($to,$subject,$message,$headers);
if($result){
    echo 'Email sent successfully to ' . $to;
}
else{
    echo 'Email not sent!';
}