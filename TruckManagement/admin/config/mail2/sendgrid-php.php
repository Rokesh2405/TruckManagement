<?php
/**
 * This file is used to load the Composer autoloader if required.
 */

require 'vendor/autoload.php';



function sendgridApiMail($to, $message, $subject, $from, $fromname)
{
    $fromname = 'worktogethergroup';
   $sendgrid = new \SendGrid('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');
     $email = new \SendGrid\Mail\Mail();
    $email->setFrom($from, $fromname);
    $email->setSubject($subject);
    $email->addTo($to);
    // $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
    $email->addContent("text/html", $message);
    $response = $sendgrid->send($email);
    return $response;
}

