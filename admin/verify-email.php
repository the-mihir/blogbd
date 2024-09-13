<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/bootstrap.php';   

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

$transport = Transport::fromDsn($_ENV['MAILER_DSN']);
$mailer = new Mailer($transport);

$email = (new Email())
    ->from($_ENV['MAILER_FROM'])
    ->to($_ENV['MAILER_TO'])
    ->subject('Verify your email')
    ->text('Thanks for signing up!');
$mailer->send($email);  

