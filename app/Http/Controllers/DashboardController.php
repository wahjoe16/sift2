<?php

namespace App\Http\Controllers;

use App\Charts\DosenPieChart;
use App\Charts\MahasiswaPieChart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function indexSidang(MahasiswaPieChart $mahasiswaPieChart, DosenPieChart $dosenPieChart)
    {
        return view('sidang', [
            'mahasiswaPieChart' => $mahasiswaPieChart->build(),
            'dosenPieChart' => $dosenPieChart->build()
        ]);
    }

    public function indexData(MahasiswaPieChart $mahasiswaPieChart, DosenPieChart $dosenPieChart)
    {
        return view('data', [
            'mahasiswaPieChart' => $mahasiswaPieChart->build(),
            'dosenPieChart' => $dosenPieChart->build()
        ]);
    }

    public function dataMahasiswa()
    {
        $data = User::where('level', 3)->orderBy('nik', 'ASC')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('foto', function ($data) {
                $path = asset("$data->foto");
                return '<img src=' . $path . ' class="img-circle img-bordered-sm" width="40"/>';
            })
            ->addColumn('aksi', function ($data) {
                return '
                <div class="btn-group">
                    <a href="' . route('mahasiswa.show', $data->id) . '"><i class="fa fa-search"></i></a>
                </div>
        ';
            })
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }

    public function dataDosen()
    {
        $data = User::where('level', 2)->orderBy('nik', 'ASC')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('foto', function ($data) {
                $path = asset("$data->foto");
                return '<img src=' . $path . ' class="img-circle img-bordered-sm" width="40"/>';
            })
            ->addColumn('aksi', function ($data) {
                return '
                <div class="btn-group">
                    <a href="' . route('dosen.show', $data->id) . '"><i class="fa fa-search"></i></a>
                </div>
        ';
            })
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }
}
