<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\WhatsAppController;
use App\Models\Laundry;
use App\Models\Storage;
use App\Models\BroadcastMessage;
use App\Models\Events;
use App\Models\Financial;

use Carbon\Carbon;
use App\Models\Order;
class TaskList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laundry notip da jalan ni';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //remainder buat hari H
        $tanggalSekarang = date('Y-m-d');
        
        $tables = ['laundries', 'storages'];
        foreach ($tables as $table) {
            if($table == 'laundries')
            {
                $data = DB::table($table)->where('tanggalAmbil', $tanggalSekarang)->get();
                foreach ($data as $d) {
                    $user = User::find($d->user_id);

                    $phone = $user->phone;
                    $data = [
                        'toNumber' => $phone,
                        'message' => 'Jangan lupa ambil laundry kamu ya gengs:)',
                    ];
                    $wa = new WhatsAppController();
                    $wa->sendMessage($data);

                    $user_id = $user->id;
                    $events = new Events();
                    $events = Events::where('user_id', $user->id)->get();
                    foreach ($events as $event) {
                        if ($event->status == 'notified') {
                            $event->status = 'Done';
                            $event->save();
                        }
                    }
                }
            }else
            {
                $data = DB::table($table)->where('tanggalKeluar', $tanggalSekarang)->get();

                foreach ($data as $d) {
                    $user = User::find($d->user_id);

                    $phone = $user->phone;
                    $data = [
                        'toNumber' => $phone,
                        'message' => 'Jangan lupa ambil barang kamu di Kulkas ya gengs:)',
                    ];

                    $wa = new WhatsAppController();
                    $wa->sendMessage($data);

                    $user_id = $user->id;
                    $events = new Events();
                    $events = Events::where('user_id', $user->id)->get();
                    foreach ($events as $event) {
                        if ($event->status == 'notified') {
                            $event->status = 'Done';
                            $event->save();
                        }
                    }
                }
            }
        }
        

        //remainder buat h-1
        // set for events
        $tanggalBesok = Carbon::tomorrow()->format('Y-m-d');
        $tables_to_check = ['laundries','storages'];

        //call a table to insert
        $events = new Events();

        foreach ($tables_to_check as $table) {
            if($table == 'laundries')
            {
                $data = DB::table($table)->where('tanggalAmbil', $tanggalBesok)->get();
                foreach ($data as $d) {
                    $user = User::find($d->user_id);
                    $user_id = $d->user_id;
                    $laundry_id = $d->id;
                    $vendor_id = $d->laundry_vendor_id;
                    $vendor_name = DB::table('laundry_vendors')->where('id', $vendor_id)->first();
                    $vendor_name = $vendor_name->name;
                    $tanggalAmbil = $d->tanggalAmbil;
                    
                    $message = 'Jangan lupa ambil laundry kamu dengan kode ' . $laundry_id . ' di ' . $vendor_name . ' ya gengs:)';
                    $events->name = 'Ambil Laundry';
                    $events->user_id = $user_id;
                    $events->description = $message;
                    $events->tanggal = $tanggalAmbil;
                    $events->status = 'notified';
                    $events->save();

                    $phone = $user->phone;
                    $data = [
                        'toNumber' => $phone,
                        'message' => 'Pesan untuk besok: '."\n".$message,
                    ];
                    $wa = new WhatsAppController();
                    $wa->sendMessage($data);
                }
            }else
            {
                $data = DB::table($table)->where('tanggalKeluar', $tanggalBesok)->get();
                foreach ($data as $d) {
                    $user = User::find($d->user_id);
                    $user_id = $d->user_id;
                    $barang = $d->namaBarang;
                    $lantai = $d->lantai;
                    $tanggalKeluar = $d->tanggalKeluar;

                    $message = 'Jangan lupa keluarkan barang kamu ' . $barang . ' di kulkas lantai ' . $lantai . ' ya gengs:)';
                    $events->name = 'Keluarkan Barang di Kulkas';
                    $events->user_id = $user_id;
                    $events->description = $message;
                    $events->tanggal = $tanggalKeluar;
                    $events->status = 'notified';
                    $events->save();

                    $phone = $user->phone;
                    $data = [
                        'toNumber' => $phone,
                        'message' => 'Pesan untuk besok: '."\n".$message,
                    ];

                    $wa = new WhatsAppController();
                    $wa->sendMessage($data);
                }
            }
        }

        //buat financials
        $tanggalSekarang = Carbon::now()->format('d');
        if($tanggalSekarang == '01')
        {
            $bulanLalu = Carbon::now()->subMonth()->format('m');
            $laundries = DB::table('laundries')
            ->whereMonth('created_at', $bulanLalu)
            ->get();

            $orders = DB::table('orders')
            ->whereMonth('created_at', $bulanLalu)
            ->get();

            $users = User::where('role', 'user')->get();
            foreach($users as $user)
            {
                $financials = new Financial();
                $financials->name = $bulanLalu;
                $financials->user_id = $user->id;
                $total_laundry = 0;

                foreach($laundries as $l)
                {
                    if($l->user_id == $user->id)
                    {
                        $total_laundry += $l->total_price;
                    }
                }

                $total_shopping = 0;
                foreach($orders as $or)
                {
                    if($or->user_id == $user->id)
                    {
                        $total_shopping += $or->total_price;
                    }
                }

                $financials->transaction_amount = $total_laundry+$total_shopping;
                $financials->save();
                
                $phone = $user->phone;
                $name = $user->name;
                
                $data = [
                    'toNumber' => $phone,
                    'message' => 'Haloww '.$name.' gimana kabarnya nih?'. `\n`.'Riwayat Finansial bulan lalu kamu sudah ada di MyFinancial nich, yuk di ceks',
                ];
                $wa = new WhatsAppController();
                $wa->sendMessage($data);

                $vendor = User::where('role', 'vendor')->get();
                foreach($vendor as $v)
                {
                    // get laundry transaction by vendor
                    $laundry = DB::table('laundries')
                    ->whereMonth('created_at', $bulanLalu)
                    ->where('laundry_vendor_id', $v->id)
                    ->get();

                    $total_laundry = 0;
                    $total_bags = 0;
                    foreach($laundry as $l)
                    {
                        $total_laundry += $l->total_price;
                        $total_bags += 1;
                    }

                    $financials = new Financial();
                    $financials->name = $bulanLalu;
                    $financials->user_id = $v->id;  
                    $financials->transaction_amount = $total_laundry;
                    $financials->total_transaction = $total_bags;
                    $financials->save();

                    $phone = $v->phone;
                    $name = $v->name;

                    $data = [
                        'toNumber' => $phone,
                        'message' => 'Haloww '.$name.' gimana kabarnya nih?'. `\n`.'Riwayat Finansial bulan lalu kamu sudah ada di MyFinancial nich, yuk di ceks',
                    ];

                    $wa->sendMessage($data);
                }

                $admin = User::where('role', 'admin')->get();
                foreach($admin as $a)
                {
                    $order = DB::table('orders')
                    ->whereMonth('created_at', $bulanLalu)
                    ->where('payment_status', '2')
                    ->get();

                    $total_shopping = 0;
                    $total_orders = 0;
                    foreach($order as $o)
                    {
                        $total_shopping += $o->total_price;
                        $total_orders += 1;
                    }

                    $financials = new Financial();
                    $financials->name = $bulanLalu;
                    $financials->user_id = $a->id;
                    $financials->transaction_amount = $total_shopping;
                    $financials->total_transaction = $total_orders;
                    $financials->save();

                    $phone = $a->phone;
                    $name = $a->name;

                    $data = [
                        'toNumber' => $phone,
                        'message' => 'Haloww '.$name.' gimana kabarnya nih?'. `\n`.'Riwayat Finansial bulan lalu sudah ada di MyFinancial nich, yuk di ceks',
                    ];

                    $wa->sendMessage($data);
                }
            }  
        }

        // buat order transaction
        $orders = Order::where('payment_status', '2')
        ->where('expired_time', '<', Carbon::now())
        ->get();

        foreach($orders as $o)
        {
            $o->payment_status = '3';
            $o->save();
        }
    }
}
