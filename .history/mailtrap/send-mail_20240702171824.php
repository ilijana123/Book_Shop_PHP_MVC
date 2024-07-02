<?php

use Mailtrap\Config;
use Mailtrap\EmailHeader\CategoryHeader;
use Mailtrap\EmailHeader\CustomVariableHeader;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\UnstructuredHeader;

require __DIR__ . '/vendor/autoload.php';

// Your API token from here https://mailtrap.io/api-tokens
$apiKey = getenv('MAILTRAP_API_KEY');
$mailtrap = new MailtrapClient(new Config($apiKey));

$email = (new Email())
    ->from(new Address('example@your-domain-here.com', 'Mailtrap Test'))
    ->replyTo(new Address('reply@your-domain-here.com'))
    ->to(new Address('email@example.com', 'Jon')) // Single recipient
    ->priority(Email::PRIORITY_HIGH)
    ->subject('Best practices of building HTML emails')
    ->text('Hey! Learn the best practices of building HTML emails and play with ready-to-go templates. Mailtrap's Guide on How to Build HTML Email is live on our blog');

// Headers
$email->getHeaders()
    ->addTextHeader('X-Message-Source', 'domain.com')
    ->add(new UnstructuredHeader('X-Mailer', 'Mailtrap PHP Client')); // the same as addTextHeader

// Custom Variables
$email->getHeaders()
    ->add(new CustomVariableHeader('user_id', '45982'))
    ->add(new CustomVariableHeader('batch_id', 'PSJ-12'));

// Category (should be only one)
$email->getHeaders()
    ->add(new CategoryHeader('Integration Test'));

try {
    $response = $mailtrap->sending()->emails()->send($email); // Email sending API (real)
    
    var_dump(ResponseHelper::toArray($response)); // body (array)
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>