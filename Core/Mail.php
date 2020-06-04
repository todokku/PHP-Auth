<?php
namespace Http;

class Mail
{
    public function send($to, $subject, $message, $headers = null)
    {
        $message = require $message;
        mail($to, $subject, $message, $headers);
    }
}
