<?php

namespace Mchellamuthu\Textlocal;

class Textlocal {
  protected $apikey;
  protected $sender;

  public function __construct()
  {
    $this->apikey = urlencode(config('textlocal.key'));
    $this->sender = urlencode(config('textlocal.sender'));
  }

  public function send($numbers=array(),$message)
  {

    $message = rawurlencode($message);
    $numbers = implode(',', $numbers);
    // Prepare data for POST request
    $data = array('apikey' => $this->apikey, 'numbers' => $numbers, "sender" => $this->sender, "message" => $message);
    // Send the POST request with cURL
    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
  }
}
