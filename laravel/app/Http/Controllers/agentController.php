<?php

namespace App\Http\Controllers;

use App\Laporan;
use App\Reward;
use App\Media;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Validator;

class agentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:agent');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index_agent(){
        return view('landing.index');
    }

    public function laporan_index(){
        $laporan = Laporan::orderBy('id', 'desc')->get();
        $reward = Reward::orderBy('id', 'desc')->get();
        return view('landing.page_laporan',compact('laporan', 'reward'));
    }

    public function logout(Request $request)
    {
      Auth::guard('agent')->logout();

      $request->session()->invalidate();

      return redirect('/login');
  }

  public function upload(Request $request)
  {
    dd($request->file);
    return response()->json($request->file('file'), 200);
}

public function createlaporan(Request $request)
{
    $data = [];
    $data['id_users'] = $request->id;
    $data['alamat'] = $request->alamat;
    $data['perihal'] = $request->perihal;
    $laporan = Laporan::create($data);

    $files =  $request->file('file');
    foreach ($files as $i => $dta) {
        $nama_foto = 'img_laporan_'.$i.time().'.'.$dta->getClientOriginalExtension();

        $media = [];
        $media['laporan_id'] = $laporan->id;
        $media['foto'] = $nama_foto;
        Media::create($media);

        $path = 'assets/img/laporan';
        $dta->move($path, $nama_foto);
    }
    return response()->json('success', 200);        
}

public function daftar_agent(Request $request){
    $request->validate([
        'no_ktp' => 'required|unique:users',
        'email' => 'required|unique:users',
        'password' => 'required|min:6'
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->no_ktp = $request->no_ktp;
    $user->no_telepon = $request->no_telepon;
    $user->email = $request->email;
    $user->role = 'agent';
    $user->status = 'Active';
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect('agent/register?success=true');
}

public function setrek(Request $request) {
    $updt_rek = User::where('id', $request->id)->first();
    $updt_rek->no_rekening = $request->no_rekening;
    $updt_rek->nama_bank = $request->nama_bank;
    $updt_rek->atas_nama = $request->atas_nama;
    $updt_rek->save();

    return redirect('agent?success=true');
}

public function updateakunagent(Request $request)
{
    $akun = User::where('id', $request->id)->first();
    if ($akun->no_ktp != $request->no_ktp) 
        $request->validate(['no_ktp' => 'unique:users']);
    if ($akun->email != $request->email) 
        $request->validate(['email' => 'unique:users']);
    $akun->name = $request->name;
    $akun->no_ktp = $request->no_ktp;
    $akun->no_telepon = $request->no_telepon;
    $akun->email = $request->email;
    if ($request->password) {
        $request->validate(['password' => 'min:6']);
        $akun->password = Hash::make($request->password);
    }
    $akun->no_rekening = $request->no_rekening;
    $akun->nama_bank = $request->nama_bank;
    $akun->atas_nama = $request->atas_nama;
    $akun->save();

    return redirect('agent?success=true');
}

//     revisi
// list Opsi
// 1. Laporan terkirim = 25
// 2. Laporan diterima = 50
// 3. Sedang di tinjau = 75
// 4. Selesai  = 100

public function agent_register(){
    return view('auth.daftar');
}

public function registerStore(Request $request){
    dd($request->all());
}
}
