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
        // // get the phone number from the request
        // $phone = $data['toNumber'];
        // // get the message from the request
        // $message = $data['message'];
        // // get the twilio account sid from .env
        // $account_sid = "AC4a3871c32360b62e9efc93df64978061";
        // // get the twilio auth token from .
        // $auth_token = "410ff3708a51dbfa11650f8cede08f34";
        // // get the twilio phone number from .env
        // $twilio_number = "17727582438";
        // // create a new twilio client
        // $client = new Client($account_sid, $auth_token);
        // // send the message to the phone number
        // $message = $client->messages->create(
        //     "whatsapp:+62$phone",
        //     array(
        //         'from' => $twilio_number,
        //         'body' => $message
        //     )
        // );

        // return response()->json(['success' => 'Message sent successfully']);

        

        $number = $data['toNumber'];
        $message = $data['message'];

        // $url = "https://api.whatsapp.com/v1/messages/".$number."?token=EAAJ4Va6GOZBQBAPZBZAZA69ZBpy95ecICTiZAg0ly5YKHCVlxyn8KkWA07RZBjPoQIkPoaogSvyT4dhLUj7owtGh2D9s8WuycfxuxPZBRZCAYNTl0MmQF7DICvMl8Gw8VsrjzbLnpUMNXpdd1ZBrhh44ydxpa3dMCLJBy9T75vZBOHrL6DUjWNONWmbF4kIlYRReVSvfxDzJiEqsQZDZD";
        // $data = array("phone" => $number, "body" => $message);                                                                    
        // $data_string = json_encode($data);

        // $ch = curl_init($url);                                                                      
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        //     'Content-Type: application/json',                                                                                
        //     'Content-Length: ' . strlen($data_string))                                                                       
        // );                                                                                                                   

        // $result = curl_exec($ch);

        // return $result;

        $wa     = new WhatsAppSG();
        $wa->setPort('8888')
            ->setSenderPhone('085888372505')
            ->setRecepient($number)
            ->setMessage($message);
            
        var_dump($wa->SendText());
    }
}
