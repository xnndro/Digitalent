<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laundry;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classes;
use App\Models\LaundryVendor;
use App\Models\LaundryType;
use App\Models\TransactionTemp;
use Carbon\Carbon;
use Alert;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\Complain;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laundries = Laundry::where('status', '=', 'inputed')->orderBy('tanggalVendor', 'asc')->get();
        //get user name
        foreach ($laundries as $laundry) {
            $laundry->user = User::find($laundry->user_id)->name;
            $laundry->type = LaundryType::find($laundry->laundry_type_id)->name;
            $laundry->vendor = LaundryVendor::find($laundry->laundry_vendor_id)->name;
        }

        // count order each vendor
        $femme = 0;
        $bclean = 0;
        $mills = 0;

        foreach($laundries as $l)
        {
            if($l->laundry_vendor_id == '1')
            {
                $femme++;
            }else if($l->laundry_vendor_id == '2')
            {
                $bclean++;
            }else
            {
                $mills++;
            }
        }

        $count = $laundries->count();

        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }
        return view('admin.pages.laundry.index', compact('laundries', 'count','femme','bclean','mills'));
    }

    public function vendortoadmin()
    {
        $laundries = Laundry::where('status', '=', 'Delivered')->orderBy('tanggalAmbil', 'asc')->get();
        //get user name
        foreach ($laundries as $laundry) {
            $laundry->user = User::find($laundry->user_id)->name;
            $laundry->type = LaundryType::find($laundry->laundry_type_id)->name;
            $laundry->vendor = LaundryVendor::find($laundry->laundry_vendor_id)->name;
        }

        $femme = 0;
        $bclean = 0;
        $mills = 0;

        foreach($laundries as $l)
        {
            if($l->laundry_vendor_id == '1')
            {
                $femme++;
            }else if($l->laundry_vendor_id == '2')
            {
                $bclean++;
            }else
            {
                $mills++;
            }
        }

        $count = $laundries->count();
        return view('admin.pages.laundry.transaction', compact('laundries', 'count','femme','bclean','mills'));
    }

    public function history()
    {
        $laundries = Laundry::where('status', '=', 'Done')->orderBy('tanggalAmbil', 'asc')->get();
        //get user name
        foreach ($laundries as $laundry) {
            $laundry->user = User::find($laundry->user_id)->name;
            $laundry->type = LaundryType::find($laundry->laundry_type_id)->name;
            $laundry->vendor = LaundryVendor::find($laundry->laundry_vendor_id)->name;
        }

        $femme = 0;
        $bclean = 0;
        $mills = 0;

        foreach($laundries as $l)
        {
            if($l->laundry_vendor_id == '1')
            {
                $femme++;
            }else if($l->laundry_vendor_id == '2')
            {
                $bclean++;
            }else
            {
                $mills++;
            }
        }

        $count = $laundries->count();
        return view('admin.pages.laundry.history', compact('laundries', 'count','femme','bclean','mills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // temporary variable

    public function create()
    {
        //get class from table users and if the admin choose the class, then show all users with that class
        // $users = User::all();
        $class = Classes::where('jumlahSiswa', '>', 0)->get();
        $type = LaundryType::all();
        $count = Classes::count();
        return view('admin.pages.laundry.create', compact('class','count','type'));
    }

    public function bridge(Request $request)
    {
        $class = $request->get('class');
        $type = $request->get('type');
        // insert into transaction temp
        $transactionTemp = new TransactionTemp;
        $transactionTemp->kelas = $class;
        $transactionTemp->type = $type;
        $transactionTemp->save();
        return redirect()->route('laundries.transaction'); 
    }

    public function transaction()
    {
        // get the class and type from transaction temp table last inserted
        $transactionTemp = new TransactionTemp;
        $user = new User;

        $transactionTemp = TransactionTemp::latest()->first();
        $class = $transactionTemp->kelas;
        $type = $transactionTemp->type;
        // $users = User::where('class_id', $class)->get();
        // $users = User::all();
        $username = $user->where('class_id', $class)->get();
        $vendors = LaundryVendor::all();
        $count = $username->count();
        $visible = 'hidden';

        return view('admin.pages.laundry.addTransaction', compact('username','vendors','type','class','count','visible'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required',
        //     'total_pcs' => 'required|integer',
        //     'total_kg' => 'required|integer',
        //     'vendor' => 'required',
        //     'tanggalMasuk' => 'required|date',
        //     'tanggalAmbil' => 'required|date',
        //     // 'status' => 'required',
        //     'type_id' => 'required',
        // ]);
        
        // check the type first then do operation for price
        $total_price = 0;   
        $type = LaundryType::find($request->get('type_id'));
        if($request->get('type_id') == 1){
            if($request->get('total_kg') <= $type->minimal_unit){
                $total_price = $type->minimal_unit * $type->price;
            }else{
                $total_price = $request->get('total_kg') * $type->price;
            }
        }else if($request->get('type_id') == 2 || $request->get('type_id') == 3){
            if($request->get('total_pcs') <= $type->minimal_unit){
                $total_price = $type->minimal_unit * $type->price;
            }else{
                $total_price = $request->get('total_pcs') * $type->price;
            }
        }

        
        $tanggalVendor = '';
        $tanggalMasuk = Carbon::parse($request->get('tanggalMasuk'))->format('l');
        $jamMasuk = Carbon::now()->format('H:i:s');
        if($tanggalMasuk == 'Monday' || $tanggalMasuk == 'Wednesday' || $tanggalMasuk == 'Friday'){
            if($jamMasuk < '08:00:00'){
                $tanggalVendor = $request->get('tanggalMasuk');
            }else{
                if($tanggalMasuk == 'Monday' || $tanggalMasuk == 'Wednesday')
                    $tanggalVendor = Carbon::parse($request->get('tanggalMasuk'))->addDays(2);
                else
                    $tanggalVendor = Carbon::parse($request->get('tanggalMasuk'))->addDays(3);
            }
        }else{
            if($tanggalMasuk == 'Tuesday' || $tanggalMasuk == 'Thursday' || $tanggalMasuk == 'Sunday'){
                $tanggalVendor = Carbon::parse($request->get('tanggalMasuk'))->addDays(1);
            }else if($tanggalMasuk == 'Saturday'){
                $tanggalVendor = Carbon::parse($request->get('tanggalMasuk'))->addDays(2);
            }
        }

        // make a id for the laundry
        $id = '';
        $laundry = new Laundry;
        $laundry = Laundry::latest()->first();
        if($laundry == null){
            $id = 'LDR0001';
        }else{
            $id = $laundry->laundry_transaction_id;
            $id = substr($id, 3);
            $id = (int)$id;
            $id = $id + 1;
            $id = 'LDR' . sprintf('%04s', $id);
        }

        $tanggalAmbil = (new Carbon($tanggalVendor))->addDays(2);
        
        $request->merge([
            'laundry_transaction_id' => $id,
            'user_id' => $request->get('nama'),
            'laundry_vendor_id' => $request->get('vendor'),
            'laundry_type_id' => $request->get('type_id'),
            'tanggalVendor' => $tanggalVendor,
            'tanggalAmbil' => $tanggalAmbil,
            'tanggalMaxComplain' => (new Carbon($tanggalAmbil))->addDays(2),
            'status' => 'Inputed',
            'total_price' => $total_price,
        ]);

        // insert to laundries table
        $laundry = Laundry::create($request->all());

        // delete the last inserted data from transaction temp
        // $transactionTemp = new TransactionTemp;
        // $transactionTemp = TransactionTemp::latest()->first();
        // $transactionTemp->delete();

        $user = User::find($request->get('nama'));
        $user_name = $user->name;
        $user_phone = $user->phone;
        $tanggalAmbil = $request->get('tanggalAmbil')->format('d-m-Y');

        // get vendor name
        $vendor = LaundryVendor::find($request->get('vendor'));
        $vendor = $vendor->name;

        try
        {   
            $data = [
                'toNumber' => $user_phone,
                'message' => 'Hi, ' . $user_name . ' Transaksi Laundry dengan ID ' . $id . ' dengan Vendor ' . $vendor . '. Silahkan ambil pada tanggal ' . $tanggalAmbil . '. Terima Kasih.'
            ];
            
            // send message
            $whatsapp = new WhatsappController;
            $whatsapp->sendMessage($data);
        }catch(Exception $e)
        {
            
        }

        return redirect()->route('laundries.index')
            ->with('success', 'Laundry created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laundry = Laundry::find($id);
        return redirect('laundries.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laundry = Laundry::find($id);
        $vendors = LaundryVendor::all();
        $type = LaundryType::all();
        // get the class of user from id laundry
        $user = User::find($laundry->user_id);
        $class = $user->class_id;
        $username = User::where('class_id', $class)->get();
        $visible = 'hidden';
        return view('admin.pages.laundry.edit', compact('laundry','vendors','type','username','visible'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'pcs' => 'required|numeric',
        //     'kg' => 'required|numeric',
        //     'vendor' => 'required',
        //     'tanggalAmbil' => 'required|date',
        //     'status' => 'required',
        // ]);

        $total_price = 0;  
        $type = LaundryType::find($request->get('type'));
        if($request->get('type') == 1){
            if($request->get('total_kg') <= $type->minimal_unit){
                $total_price = $type->minimal_unit * $type->price;
            }else{
                $total_price = $request->get('total_kg') * $type->price;
            }
        }else if($request->get('type') == 2 || $request->get('type') == 3){
            if($request->get('total_pcs') <= $type->minimal_unit){
                $total_price = $type->minimal_unit * $type->price;
            }else{
                $total_price = $request->get('total_pcs') * $type->price;
            }
        }

        // declare the date of vendor as date of input
        $tanggalVendor = '';
        $jamMasuk = Carbon::now()->format('H:i:s');
        $tanggalMasuk = Carbon::parse($request->get('tanggalMasuk'))->format('l');
        if($tanggalMasuk == 'Monday' || $tanggalMasuk == 'Wednesday' || $tanggalMasuk == 'Friday'){
            if($jamMasuk < '08:00:00'){
                $tanggalVendor = $request->get('tanggalMasuk');
            }else{
                if($tanggalMasuk == 'Monday' || $tanggalMasuk == 'Wednesday')
                    $tanggalVendor = Carbon::parse($request->get('tanggalMasuk'))->addDays(2);
                else
                    $tanggalVendor = Carbon::parse($request->get('tanggalMasuk'))->addDays(3);
            }
        }else{
            if($tanggalMasuk == 'Tuesday' || $tanggalMasuk == 'Thursday' || $tanggalMasuk == 'Sunday'){
                $tanggalVendor = Carbon::parse($request->get('tanggalMasuk'))->addDays(1);
            }else if($tanggalMasuk == 'Saturday'){
                $tanggalVendor = Carbon::parse($request->get('tanggalMasuk'))->addDays(2);
            }
        }

        $tanggalAmbil = (new Carbon($tanggalVendor))->addDays(2);
        $laundry = Laundry::find($id);
        $request->merge([
            'user_id' => $request->get('nama'),
            'total_kg' => $request->get('total_kg'),
            'laundry_vendor_id' => $request->get('vendor'),
            'laundry_type_id' => $request->get('type'),
            'tanggalVendor' => $tanggalVendor,
            'tanggalAmbil' => $tanggalAmbil,
            'tanggalMaxComplain' => (new Carbon($tanggalAmbil))->addDays(2),
            'status' => 'Inputed',
            'total_price' => $total_price,
        ]);
        $laundry->save();
        $laundry->update($request->all());

        return redirect()->route('laundries.index')->withSuccessMessage('Laundry updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        
        $laundry = Laundry::find($id);
        $laundry->delete();
        return redirect()->route('laundries.index')
                ->withSuccessMessage('Laundry deleted successfully');
    }
    public function taked($id)
    {
        $laundry = Laundry::find($id);
        $laundry->status = 'Taked';
        $laundry->save();
        return redirect()->route('laundries.index')->withSuccessMessage('Laundry successfully Taked');
    }

    public function done($id)
    {
        $laundry = Laundry::find($id);
        $laundry->status = 'Done';
        $laundry->save();

        // get the user phone number
        $user = User::find($laundry->user_id);
        $user_phone = $user->phone;

        $laundry_id = $laundry->laundry_transaction_id;
        try
        {
            $data = [
                'phone' => $user_phone,
                'message' => 'Hi, ' . $user->name . ' Laundry dengan ID ' . $laundry_id . ' telah selesai. Terima Kasih.'
            ];
            
            $whatsapp = new WhatsAppController();
            $whatsapp->sendMessage($data);
        }catch(\Exception $e)
        {
            return redirect()->route('laundries.index')->withSuccessMessage('Laundry successfully Done');
        }
        return redirect()->route('laundries.vendortoadmin')->withSuccessMessage('Laundry successfully Done');
    }
    
    public function vendor_index()
    {
        $vendors = LaundryVendor::all();
        if(session()->has('success_message'))
        {
            alert()->success('Success', session()->get('success_message'));
        }
        $count = $vendors->count();

        foreach($vendors as $vendor){
            // get total complaint
            $complains = Complain::where('laundry_vendor_id', $vendor->id)->get();
            $vendor->complain = $complains->count();
        }
        return view('admin.pages.laundry.vendor', compact('vendors', 'count'));
    }
    
    public function addVendor()
    {
        return view('admin.pages.laundry.addVendor');
    }

    public function storeVendor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|starts_with:08',
            'email' => 'required|email|ends_with:vendor.id',
            'password' => 'required|min:4',
        ]);

        $laundryVendor = new LaundryVendor([
            'name' => $request->get('name'),
        ]);
        $laundryVendor->save();

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user->save();


        return redirect()->route('laundries.vendor')->withSuccessMessage('Vendor added successfully');
    }

    public function editVendor($id)
    {
        $vendor = LaundryVendor::find($id);
        //mapping email
        $user = User::where('name', $vendor->name)->first();
        // dd($user,$id);
        $vendor->email = $user->email;
        $vendor->phone = $user->phone;
        $vendor->phone = $user->phone;
        return view('admin.pages.laundry.editVendor', compact('vendor'));
    }

    public function updateVendor(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|starts_with:08',
            'email' => 'required|email|ends_with:vendor.id',
            'password' => 'nullable|min:4',
        ]);

        // dd($request->all());
        $laundryVendor = LaundryVendor::find($id);
        $laundry_name = $laundryVendor->name;
        
        $user = User::where('name', $laundry_name)->first();
        // dd($user);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $laundryVendor->name = $request->get('name');
        $laundryVendor->save();

        return redirect()->route('laundries.vendor')->withSuccessMessage('Vendor updated successfully');
    }

    public function deleteVendor($id)
    {
        $laundryVendor = LaundryVendor::find($id);
        $laundry_name = $laundryVendor->name;
        $user = User::where('name', $laundry_name)->first();

        $laundry_transaction = Laundry::where('laundry_vendor_id', $id)->get();
        foreach($laundry_transaction as $laundry)
        {
            $laundry->delete();
        }
        $user->delete();
        $laundryVendor->delete();
        return redirect()->route('laundries.vendor')->withSuccessMessage('Vendor deleted successfully');
    }


    public function showComplain($id)
    {
        $laundry = Laundry::find($id);
        $complains = Complain::where('laundry_vendor_id', $id)->get();

        // get total kehilangan dari complain_type each complain
        $total_kehilangan = 0;
        $total_pakaian_kotor = 0;
        foreach($complains as $complain)
        {
            if($complain->complain_name == "Kehilangan")
            {
                $total_kehilangan += $complain->jumlahBarang;
            }else if($complain->complain_name = "Pakaian Kotor")
            {
                $total_pakaian_kotor += $complain->jumlahBarang;
            }
        }

        $total_complain = $complains->count();

        // get user name each complain
        foreach($complains as $complain)
        {
            $user = User::find($complain->user_id);
            $complain->user_name = $user->name;
        }
        return view('admin.pages.laundry.complain', compact('laundry', 'complains','total_complain', 'total_kehilangan', 'total_pakaian_kotor'));
    }
}
