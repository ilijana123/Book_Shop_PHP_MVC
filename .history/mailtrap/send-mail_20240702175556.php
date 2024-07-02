<?php
$to='nikola.petkovski01@gmail.com';
$subject='Hello!';


$message='
;
$result=mail($to,$subject,$message);
if($result){
    echo 'Email sent successfully to ' . $to;
}
else{
    echo 'Email not sent!';
}