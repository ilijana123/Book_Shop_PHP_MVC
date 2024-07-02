<?php
$to='nikola.petkovski01@gmail.com';
$subject='Hello!';


$message='
Confirmation email for your order. Thanks for buying from us.';;
$result=mail($to,$subject,$message);
if($result){
    echo 'Email sent successfully to ' . $to;
}
else{
    echo 'Email not sent!';
}