<?php

namespace App\Http\Controllers;

use App\Laporan;
use App\Reward;
use App\Media;
use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use File;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $agent = User::where('role', 'agent')->get();
        $laporan = Laporan::all();
        $laporan_new = 0;
        $laporan_thisday = 0;
        foreach ($laporan as $lap) {
            if ($lap->progres == 20) $laporan_new = 
                $laporan_new + 1;
            if (date('dmy') == date('dmy', strtotime($lap->created_at))) 
                $laporan_thisday = $laporan_thisday + 1;
        }

        $data = [
            'agent' => count($agent),
            'total_laporan' => count($laporan),
            'laporan_new' => $laporan_new,
            'laporan_thisday' => $laporan_thisday
        ];
        return view('home', compact('data'));
    }

    public function laporan()
    {
        $laporan = Laporan::orderBy('id', 'desc')->get();
        $users = User::where('role', 'agent')->get();
        $media = Media::all();
        return view('laporan', compact('laporan', 'users', 'media'));
    }

    public function dataagent()
    {
        $agent = User::where('role', 'agent')->get();
        return view('data-agent', compact('agent'));
    }

    public function edtakunagent(Request $request)
    {
        $updt_agent = User::where('id', $request->id)->first();
        $updt_agent->status = $request->status;
        if ($request->password)
            $updt_agent->password = Hash::make($request->password);
        $updt_agent->save();

        return redirect('admin/data-agent?success=true');
    }

    public function updateprogress(Request $request)
    {
        $laporan = Laporan::where('id', $request->id)->first();
        $laporan->status = $request->status;
        $laporan->progres = $request->progres;
        $laporan->save();

        return redirect('admin/laporan?success=update');
    }

    public function updateakun(Request $request)
    {
        $akun = User::where('id', $request->id)->first();
        $akun->name = $request->name;
        $akun->email = $request->email;
        if ($request->password) $akun->password = Hash::make($request->password);
        $akun->save();

        return back();
    }

    public function hapuslaporan($id)
    {
        $laporan = Laporan::where('id', $id)->first();
        $media = Media::where('laporan_id', $id)->get();
        foreach ($media as $fto) {
            File::delete('assets/img/laporan/'.$fto->foto);
        }
        $reward = Reward::where('laporan_id', $id)->first();
        if ($reward) {
            File::delete('assets/img/foto_bukti/'.$reward->foto_bukti);
            $reward->delete();
        }
        $laporan->delete();

        return redirect('admin/laporan?success=delete');
    }

    public function getMedia($id)
    {
        $media = Media::where('laporan_id', $id)->get();
        $foto = '';
        foreach ($media as $dta) {
            $foto .= '<img src="'.asset('assets/img/laporan/'.$dta->foto).'" class="img-responsive img-thumbnail" style="width: 100%; margin-bottom: 10px;">';
        }
        return response()->json($foto, 200);
    }

    public function reward()
    {
        $reward = Reward::orderBy('id', 'desc')->get();
        $laporan = Laporan::orderBy('id', 'desc')->get();
        $users = User::where('role', 'agent')->get();
        return view('reward', compact('reward', 'laporan', 'users'));
    }

    public function setreward(Request $request)
    {
        $file =  $request->file('foto_bukti');
        $nama_foto = 'transfer_'.time().'.'.$file->getClientOriginalExtension();
        $reward = new Reward();
        $reward->agent_id = $request->agent_id;
        $reward->laporan_id = $request->laporan_id;
        $reward->nominal = $request->nominal;
        $reward->foto_bukti = $nama_foto;
        $reward->status = $request->status;
        $reward->save();

        $file->move('assets/img/foto_bukti', $nama_foto);

        return redirect('admin/laporan?success=setreward');
    }

    public function updatestatusreward(Request $request)
    {
        $reward = Reward::where('id', $request->id)->first();
        $reward->status = $request->status;
        $reward->save();

        return redirect('admin/reward?success=update');
    }

    public function hapusreward($id)
    {
        $reward = Reward::where('id', $id)->first();
        File::delete('assets/img/foto_bukti/'.$reward->foto_bukti);
        $reward->delete();

        return redirect('admin/reward?success=delete');
    }

    public function getagentajx(Request $request)
    {
        $laporan = Laporan::where('id', $request->laporan_id)->first();
        $agent = User::where('id', $laporan->id_users)->first();

        return response()->json([
            'agent_id' => $agent->id,
            'nama_agent' => $agent->name,
            'rekening'  => $agent->no_rekening.' (an: '.$agent->atas_nama.')',
            'nama_bank' => $agent->nama_bank,
        ], 200);
    }

    public function laporanServerside(Request $request)
    {
        if ($request->req == 'dataLaporan') {
            if ($request->jenis == 'All')
                $result = Laporan::orderBy('id', 'desc')->get();
            else if ($request->jenis == 'Agent')
                $result = Laporan::where('id_users', $request->agent)->orderBy('id', 'desc')->get();
            else if ($request->jenis == 'Tanggal')
                $result = Laporan::where('created_at', 'like', '%'.$request->date.'%')->orderBy('id', 'desc')->get();

            $data = [];
            $no = 1;
            foreach ($result as $dta) {
                $dta->no = $no;
                $usr = User::where('id', $dta->id_users)->first();
                $dta->nama = $usr->name;
                $dta->email = $usr->email;
                $dta->no_telepon = $usr->no_telepon;
                $dta->kd_laporan = '#TA'.sprintf('%05s', $dta->id);
                $dta->tanggal = date('d/m/Y', strtotime($dta->created_at));
                $dta->status_reward = '<span class="label label-table label-primary">Belum Diberikan</span>';

                // Button Reward
                $fix = false;
                $reward = Reward::all();
                foreach ($reward as $rwd) {
                    if ($rwd->laporan_id == $dta->id) $fix = true;
                }

                if ($dta->status != 'Selesai') {
                    $btn_action = 'data-action="inProgres"';
                } else if ($fix == true) {
                    $btn_action = 'data-action="rewardDone"';   
                    $dta->status_reward = '<span class="label label-table label-success">Telah Diberikan</span>';                 
                } else {
                    $btn_action = 'data-toggle="modal" data-target=".modal-reward'.$dta->id.'"';
                }
                $dta->btn_reward = '<a href="#" class="btn btn-sm btn-warning btn-reward" '.$btn_action.' data-toggle1="tooltip" title="Berikan Reward Untuk Laporan Ini"><i class="fa fa-trophy"></i>&nbsp; Berikan Reward</a>';

                $dta->status = '<b>'.$dta->status.' ('.$dta->progres.'%)'.'</b>';
                $data[] = $dta;
                $no = $no + 1;
            }

            return Datatables::of($data)
            ->addColumn('action', function($dta) {
                return '
                <a href="#" class="text-primary" id="view-media" data-toggle="modal" data-target=".modal-foto" data-id="'.$dta->id.'" data-toggle1="tooltip" title="Lihat Lampiran Foto"><i class="fa fa-photo"></i>&nbsp;&nbsp;</a>
                <a href="#" class="text-success" data-toggle="modal" data-target=".modal-edt'.$dta->id.'" data-toggle1="tooltip" title="Update Status & Progres"><i class="fa fa-pencil"></i>&nbsp;&nbsp;</a>
                <a href="#" class="text-danger" data-toggle="modal" data-target=".modal-del'.$dta->id.'" data-toggle1="tooltip" title="Hapus Laporan"><i class="fa fa-trash"></i>&nbsp;&nbsp;</a>';
            })->rawColumns(['action', 'status', 'btn_reward', 'status_reward'])->toJson();
        } else if ($request->req == 'dataAgent') {
            $result = User::where('role', 'agent')->orderBy('id', 'desc')->get();
            $data = [];
            $no = 1;
            foreach ($result as $dta) {
                $dta->no = $no;
                $dta->tggl_daftar = date('d/m/Y', strtotime($dta->created_at));
                $dta->nama = $dta->name;
                if ($dta->status == 'Active') $dta->status = '<span class="label label-table label-success">Active</span>';
                else $dta->status = '<span class="label label-table label-danger">Suspend</span>';
                $data[] = $dta;
                $no = $no + 1;
            }

            return Datatables::of($data)
            ->addColumn('action', function($dta) {
                return '
                <a href="#" class="btn btn-sm btn-primary" style="margin-bottom: 10px; margin-top: 10px;" data-toggle1="tooltip" title="Update Akun Agent" data-toggle="modal" data-target=".modal-foto'.$dta->id.'"><i class="fa fa-user"></i> Update Akun</a>';
            })->rawColumns(['action', 'status'])->toJson();
        } else if ($request->req == 'dataReward') {
            $result = Reward::orderBy('id', 'desc')->get();
            $data = [];
            $no = 1;
            foreach ($result as $dta) {
                $user = User::where('id', $dta->agent_id)->first();
                $dta->no = $no;
                $dta->kd_laporan = '#TA'.sprintf('%05s', $dta->laporan_id);
                $dta->nama_agent = $user->name.' ('.$user->no_ktp.')';
                $dta->nominal = 'Rp. '.number_format($dta->nominal);
                $dta->tanggal = date('d/m/Y', strtotime($dta->created_at));
                $data[] = $dta;
                $no = $no + 1;
            }

            return Datatables::of($data)
            ->addColumn('action', function($dta) {
                return '
                <a href="#" class="text-primary" id="detail-reward" data-toggle="modal" data-target=".modal-detail'.$dta->id.'" data-toggle1="tooltip" title="Lihat Detail Reward"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;</a>
                <a href="#" class="text-success" data-toggle="modal" data-target=".modal-edt'.$dta->id.'" data-toggle1="tooltip" title="Update Status Reward"><i class="fa fa-pencil"></i>&nbsp;&nbsp;</a>
                <a href="#" class="text-danger" data-toggle="modal" data-target=".modal-del'.$dta->id.'" data-toggle1="tooltip" title="Hapus Data Reward"><i class="fa fa-trash"></i>&nbsp;&nbsp;</a>';
            })->rawColumns(['action', 'status'])->toJson();
        }
    }
}
