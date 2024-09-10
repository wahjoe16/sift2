<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ApproveSkkftController extends Controller
{
    public function index()
    {
        Session::put('page', 'dashboardSkkft');
        $dataPengajuan = Kegiatan::where('status_skkft', 0)->orderBy('id', 'asc')->get();
        return view('approve_skkft.index', compact('dataPengajuan'));
    }

    public function indexData()
    {
        return view('approve_skkft.data');
    }

    public function ajaxIndexData()
    {
        $data = Kegiatan::with([
            'user_skkft', 'categories_skkft', 'subcategories_skkft'
        ])->where('status_skkft', 1)->orderBy('id', 'DESC')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($data){
                return '
                    <div class="btn-group">
                        <a href="'.route('skkft.show', $data->id).'" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-search"></i></a>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function showKegiatan($id)
    {
        $data = Kegiatan::with([
            'user_skkft', 'categories_skkft', 'subcategories_skkft', 'tingkat_skkft', 'prestasi_skkft', 'jabatan_skkft'
        ])->find($id);
        // dd($data);
        return view('approve_skkft.show', compact('data'));
    }

    public function edit($id)
    {
        Session::put('page', 'dashboardSkkft');
        $dataPengajuan = Kegiatan::find($id);
        return view('approve_skkft.edit', compact('dataPengajuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_skkft' =>'required',
            'keterangan' =>'required_if:status_skkft,2',
        ],[
            'status_skkft' =>'Status SKKFT harus diisi',
            'keterangan.required_if' =>'Keterangan harus diisi'
        ]);

        $data = Kegiatan::findOrFail($id);
        $data->fill($request->input());

        // Jika diterima cari point dari tabel point_skkft
        if ($request->status_skkft == 1) {
            $poin = Kegiatan::select('poin_skkft.point')->leftJoin('poin_skkft', function($q) use($data){
                $q->on('poin_skkft.category_id', '=', 'kegiatan.category_id')
                  ->on('poin_skkft.subcategory_id', '=', 'kegiatan.subcategory_id');
                if (!is_null($data->tingkat_id)) {
                    $q->on('poin_skkft.tingkat_id', '=', 'kegiatan.tingkat_id');
                }elseif (!is_null($data->jabatan_id)) {
                    $q->on('poin_skkft.jabatan_id', '=', 'kegiatan.jabatan_id');
                }elseif (!is_null($data->prestasi_id)) {
                    $q->on('poin_skkft.prestasi_id', '=', 'kegiatan.prestasi_id');
                }
            })->where('kegiatan.id', $id)->first();

            if (!is_null($poin)) {
                $data->point = $poin->point;
            }else {
                return redirect()->back()->with('error', 'Data Kegiatan tidak valid');
            }
        }

        $data->save();
        return redirect()->route('dashboardSkkft.index')->with('success', 'Data Kegiatan SKKFT sudah diverifikasi');
    }

    public function deleteFile($buktiFisik)
    {
        $path ='mahasiswa/skkft/'. $buktiFisik;
        return File::delete($path);
    }

    public function delete($id)
    {
        $data = Kegiatan::find($id);
        if ($data->bukti_fisik!== '') $this->deleteFile($data->bukti_fisik);
        $data->delete();
        return redirect()->route('dashboardSkkft.index')->with('success', 'Data Kegiatan SKKFT Berhasil Dihapus');
    }
}
