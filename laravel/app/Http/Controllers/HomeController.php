<?php

namespace App\Http\Controllers;

use App\Laporan;
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
            if ($lap->progres == 0) $laporan_new = 
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

    public function updatepassword(Request $request)
    {
        $updt_agent = User::where('id', $request->id)->first();
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
        $laporan->delete();

        return redirect('admin/laporan?success=delete');
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
                $dta->tanggal = date('d/m/Y', strtotime($dta->created_at));
                $dta->status = '<b>'.$dta->status.' ('.$dta->progres.'%)'.'</b>';

                $data[] = $dta;
                $no = $no + 1;
            }

            return Datatables::of($data)
            ->addColumn('action', function($dta) {
                return '
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".modal-foto'.$dta->id.'" data-toggle1="tooltip" title="Lihat Lampiran Foto"><i class="fa fa-photo"></i></a>
                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-edt'.$dta->id.'" data-toggle1="tooltip" title="Update Status & Progres"><i class="fa fa-pencil"></i></a>
                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target=".modal-del'.$dta->id.'" data-toggle1="tooltip" title="Hapus Laporan"><i class="fa fa-trash"></i></a>';
            })->rawColumns(['action', 'status'])->toJson();
        } else if ($request->req == 'dataAgent') {
            $result = User::where('role', 'agent')->orderBy('id', 'desc')->get();
            $data = [];
            $no = 1;
            foreach ($result as $dta) {
                $dta->no = $no;
                $dta->tggl_daftar = date('d/m/Y', strtotime($dta->created_at));
                $dta->nama = $dta->name;
                $data[] = $dta;
                $no = $no + 1;
            }

            return Datatables::of($data)
            ->addColumn('action', function($dta) {
                return '
                <a href="#" class="btn btn-sm btn-primary" style="margin-bottom: 10px; margin-top: 10px;" data-toggle="modal" data-target=".modal-foto'.$dta->id.'"><i class="fa fa-key"></i> Update Password</a>';
            })->rawColumns(['action'])->toJson();
        }
    }
}
