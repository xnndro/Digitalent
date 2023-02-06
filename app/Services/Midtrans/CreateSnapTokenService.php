<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
use Midtrans\Config;
 
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken()
    {

        // $params = [
        //     'transaction_details' => [
        //         'order_id' => $this->order->number,
        //         'gross_amount' => $this->order->total_price,
        //     ],
        //     'customer_details' => [
        //         'first_name' => 'Martin Mulyo Syahidin',
        //         'email' => 'alexandro.alvin98@gmail.com',
        //         'phone' => '085888372505',
        //     ]
        // ];
 
        // $snapToken = Snap::getSnapToken($params);
 
        // return $snapToken;

        Config::$serverKey = 'Mid-server-cbsTDSJCb34Y4bAR2j56H7h1';

        // Get server key
        $serverKey = Config::$serverKey;

        $transaction_data = [
            'transaction_details' => [
                'order_id' => $this->order->number,
                'gross_amount' => $this->order->total_price,
            ]
        ];
        
        $snap = new Snap();
        $snapToken = $snap->getSnapToken($transaction_data);

        return $snapToken;
    }
}