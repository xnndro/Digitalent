<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use ay4t\WhatsAppHelper\WhatsAppSG;

class WhatsAppController extends Controller
{
    // function sendMessage where the request is get from another controller
    public function sendMessage($data)
    {
        $number = $data['toNumber'];
        $message = $data['message'];

        $wa     = new WhatsAppSG();
        $wa->setPort('8999')
            ->setSenderPhone('085888372505')
            ->setRecepient($number)
            ->setMessage($message);
    }
}
