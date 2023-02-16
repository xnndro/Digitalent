<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;
use App\Models\TypeOfStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WhatsappController;
use Alert;
use App\models\Roommate;
use App\Models\Room;

class StoragesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storages = Storage::where('user_id', Auth::id())->get();
        $storages = $storages->sortBy('tanggalKeluar');
        foreach ($storages as $storage) {
            $type = TypeOfStorage::find($storage->typeOfStorage_id);
            if ($type) {
                $storage->typeOfStorage_id = $type->name;
            } else {
                $storage->typeOfStorage_id = 'Tidak Dikenal';
            }
        }

        $count = Storage::where('user_id', Auth::id())->count();
        // $count = 0;

        $tanggalSekarang = date('Y-m-d');
        // check the expiry date and change the status
        foreach ($storages as $storage) {
            if ($storage->status == 'available') {
                if ($tanggalSekarang >$storage->tanggalKeluar) {
                    $storage->status = 'expired';
                    $storage->save();
                }
            }
        }

        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }else if(session('error_message'))
        {
            Alert::error('Error', session('error_message'));
        }
        
        return view('user.pages.storages.index', compact('storages','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $roommate = Roommate::where(function($query) use($user_id){
            $query->where('user_id', $user_id)
                ->orWhere('requested_user_id', $user_id);
        })->where('status', 'accepted')->first();
        
        if (!$roommate) {
            return redirect()->route('storages.index')->withErrorMessage("You Don't Have a Room Right Now! Request a Roommate First!");
        }else
        {
            $room = Room::find($roommate->room_id);
            $lantai = $room->lantai;
            $typeOfStorages = TypeOfStorage::all();
            return view('user.pages.storages.create', compact('typeOfStorages','lantai'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'typeOfStorage_id' => 'required|integer',
            'lantai' => 'required|integer|max:5',
            'tanggalMasuk' => 'required|date',
        ]);

        
        $typeOfStorage = TypeOfStorage::findOrFail($request->typeOfStorage_id);
        $tanggalKeluar = (new Carbon($request->tanggalMasuk))->addDays($typeOfStorage->expiry_date);
        $request->merge([
            'user_id' => auth()->user()->id,
            'tanggalKeluar' => $tanggalKeluar,
            'status' => 'available'
        ]);
        
        $storage = Storage::create($request->all());

        // get user phone
        $user = Auth::user();
        $phone = $user->phone;
        $tanggalKeluar= $tanggalKeluar->format('d-m-Y');
        // data to send to whatsapp
        $data = [
            'toNumber' => $phone,
            'message' => 'Hi, ' . $user->name . ' Silahkan memasukkan ' . $request->get('namaBarang') . ' ke dalam Kulkas, dengan tanggal keluar ' . $tanggalKeluar . '. Terima kasih telah mengisi kulkas:) .'
        ];

        // send message
        $whatsapp = new WhatsappController;
        $whatsapp->sendMessage($data);

        return redirect()->route('storages.index')->withSuccessMessage('Storage created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $storage = Storage::with('typeOfStorage')->findOrFail($id);
        return view('user.pages.storages.show', compact('storage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storage = Storage::findOrFail($id);
        $typeOfStorages = TypeOfStorage::all();
        return view('user.pages.storages.edit', compact('storage', 'typeOfStorages'));
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
        $storage = Storage::findOrFail($id);
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'typeOfStorage_id' => 'required|integer',
            'lantai' => 'required|integer|max:5',
            'tanggalMasuk' => 'required|date',
        ]);

        $typeOfStorage = TypeOfStorage::findOrFail($request->typeOfStorage_id);
        $request->merge([
            'user_id' => auth()->user()->id,
            'tanggalKeluar' => (new Carbon($request->tanggalMasuk))->addDays($typeOfStorage->expiry_date),
            'status' => 'available'
        ]);

        $storage->update($request->all());
        return redirect()->route('storages.index')->withSuccessMessage('Storage updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storage = Storage::findOrFail($id);
        $storage->delete();
        return redirect()->route('storages.index')->withSuccessMessage('Storage deleted successfully');
    }
}
