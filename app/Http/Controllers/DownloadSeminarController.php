<?php

namespace App\Http\Controllers;

use App\Models\DaftarSeminar;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Composer\Util\Zip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use ZipArchive;

class DownloadSeminarController extends Controller
{
    public function indexTmb()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('download_seminar.tmb.index', compact('ta', 'smt'));
    }

    public function dataTmb()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
            ->where([
                'program_studi' => 'Teknik Pertambangan',
            ]);

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('syarat_1', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_1 . '" target="_blank">' . $data->syarat_1 . '</a>';
            })
            ->addColumn('syarat_2', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_2 . '" target="_blank">' . $data->syarat_2 . '</a>';
            })
            ->addColumn('syarat_3', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_3 . '" target="_blank">' . $data->syarat_3 . '</a>';
            })
            ->addColumn('syarat_4', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_4 . '" target="_blank">' . $data->syarat_4 . '</a>';
            })
            ->addColumn('syarat_5', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_5 . '" target="_blank">' . $data->syarat_5 . '</a>';
            })
            ->addColumn('syarat_6', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_6 . '" target="_blank">' . $data->syarat_6 . '</a>';
            })
            ->addColumn('syarat_7', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_7 . '" target="_blank">' . $data->syarat_7 . '</a>';
            })
            ->addColumn('syarat_8', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_8 . '" target="_blank">' . $data->syarat_8 . '</a>';
            })
            ->addColumn('syarat_9', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_9 . '" target="_blank">' . $data->syarat_9 . '</a>';
            })
            ->addColumn('syarat_10', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_10 . '" target="_blank">' . $data->syarat_10 . '</a>';
            })
            ->addColumn('syarat_11', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_11 . '" target="_blank">' . $data->syarat_11 . '</a>';
            })
            ->addColumn('syarat_12', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_12 . '" target="_blank">' . $data->syarat_12 . '</a>';
            })
            ->addColumn('syarat_13', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_13 . '" target="_blank">' . $data->syarat_13 . '</a>';
            })
            ->addColumn('syarat_14', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_14 . '" target="_blank">' . $data->syarat_14 . '</a>';
            })
            // ->addColumn('select_all_syarat1', function ($data) {
            //     return '<a href="' . route('downloadPwk', $data->id) . '"><i class="fa fa-download"></i></a>';
            // })
            // ->addColumn('select_all_syarat2', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat2" value="' . $data->syarat_2 . '" />';
            // })
            // ->addColumn('select_all_syarat3', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat3" value="' . $data->syarat_3 . '" />';
            // })
            // ->addColumn('select_all_syarat4', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat4" value="' . $data->syarat_4 . '" />';
            // })
            // ->addColumn('select_all_syarat5', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat5" value="' . $data->syarat_5 . '" />';
            // })
            // ->addColumn('select_all_syarat6', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat6" value="' . $data->syarat_6 . '" />';
            // })
            // ->addColumn('select_all_syarat7', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat7" value="' . $data->syarat_7 . '" />';
            // })
            // ->addColumn('select_all_syarat8', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat8" value="' . $data->syarat_8 . '" />';
            // })
            // ->addColumn('select_all_syarat9', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat9" value="' . $data->syarat_9 . '" />';
            // })
            // ->addColumn('select_all_syarat10', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat10" value="' . $data->syarat_10 . '" />';
            // })
            ->rawColumns([
                'status',
                'syarat_1', 'syarat_2', 'syarat_3', 'syarat_4', 'syarat_5', 'syarat_6', 'syarat_7', 'syarat_8', 'syarat_9', 'syarat_10', 'syarat_11', 'syarat_12', 'syarat_13', 'syarat_14',
                // 'select_all_syarat1', 
                // 'select_all_syarat2',
                // 'select_all_syarat3',
                // 'select_all_syarat4',
                // 'select_all_syarat5',
                // 'select_all_syarat6',
                // 'select_all_syarat7',
                // 'select_all_syarat8',
                // 'select_all_syarat9',
                // 'select_all_syarat10',
            ])
            ->make(true);
    }

    public function indexTi()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('download_seminar.ti.index', compact('ta', 'smt'));
    }

    public function dataTi()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
            ->where([
                'program_studi' => 'Teknik Industri',
            ]);

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('syarat_1', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_1 . '" target="_blank">' . $data->syarat_1 . '</a>';
            })
            ->addColumn('syarat_2', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_2 . '" target="_blank">' . $data->syarat_2 . '</a>';
            })
            ->addColumn('syarat_3', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_3 . '" target="_blank">' . $data->syarat_3 . '</a>';
            })
            ->addColumn('syarat_4', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_4 . '" target="_blank">' . $data->syarat_4 . '</a>';
            })
            ->addColumn('syarat_5', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_5 . '" target="_blank">' . $data->syarat_5 . '</a>';
            })
            ->addColumn('syarat_6', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_6 . '" target="_blank">' . $data->syarat_6 . '</a>';
            })
            ->addColumn('syarat_7', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_7 . '" target="_blank">' . $data->syarat_7 . '</a>';
            })
            ->addColumn('syarat_8', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_8 . '" target="_blank">' . $data->syarat_8 . '</a>';
            })
            ->addColumn('syarat_9', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_9 . '" target="_blank">' . $data->syarat_9 . '</a>';
            })
            // ->addColumn('select_all_syarat1', function ($data) {
            //     return '<a href="' . route('downloadPwk', $data->id) . '"><i class="fa fa-download"></i></a>';
            // })
            // ->addColumn('select_all_syarat2', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat2" value="' . $data->syarat_2 . '" />';
            // })
            // ->addColumn('select_all_syarat3', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat3" value="' . $data->syarat_3 . '" />';
            // })
            // ->addColumn('select_all_syarat4', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat4" value="' . $data->syarat_4 . '" />';
            // })
            // ->addColumn('select_all_syarat5', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat5" value="' . $data->syarat_5 . '" />';
            // })
            // ->addColumn('select_all_syarat6', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat6" value="' . $data->syarat_6 . '" />';
            // })
            // ->addColumn('select_all_syarat7', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat7" value="' . $data->syarat_7 . '" />';
            // })
            // ->addColumn('select_all_syarat8', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat8" value="' . $data->syarat_8 . '" />';
            // })
            // ->addColumn('select_all_syarat9', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat9" value="' . $data->syarat_9 . '" />';
            // })
            // ->addColumn('select_all_syarat10', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat10" value="' . $data->syarat_10 . '" />';
            // })
            ->rawColumns([
                'status',
                'syarat_1', 'syarat_2', 'syarat_3', 'syarat_4', 'syarat_5', 'syarat_6', 'syarat_7', 'syarat_8', 'syarat_9',
                // 'select_all_syarat1', 
                // 'select_all_syarat2',
                // 'select_all_syarat3',
                // 'select_all_syarat4',
                // 'select_all_syarat5',
                // 'select_all_syarat6',
                // 'select_all_syarat7',
                // 'select_all_syarat8',
                // 'select_all_syarat9',
                // 'select_all_syarat10',
            ])
            ->make(true);
    }

    public function indexPwk()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('download_seminar.pwk.index', compact('ta', 'smt'));
    }

    public function dataPwk()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
            ->where([
                'program_studi' => 'Perencanaan Wilayah dan Kota',
            ]);

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('syarat_1', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_1 . '" target="_blank">' . $data->syarat_1 . '</a>';
            })
            ->addColumn('syarat_2', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_2 . '" target="_blank">' . $data->syarat_2 . '</a>';
            })
            ->addColumn('syarat_3', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_3 . '" target="_blank">' . $data->syarat_3 . '</a>';
            })
            ->addColumn('syarat_4', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_4 . '" target="_blank">' . $data->syarat_4 . '</a>';
            })
            ->addColumn('syarat_5', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_5 . '" target="_blank">' . $data->syarat_5 . '</a>';
            })
            ->addColumn('syarat_6', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_6 . '" target="_blank">' . $data->syarat_6 . '</a>';
            })
            ->addColumn('syarat_7', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_7 . '" target="_blank">' . $data->syarat_7 . '</a>';
            })
            ->addColumn('syarat_8', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_8 . '" target="_blank">' . $data->syarat_8 . '</a>';
            })
            ->addColumn('syarat_9', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_9 . '" target="_blank">' . $data->syarat_9 . '</a>';
            })
            ->addColumn('syarat_10', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_10 . '" target="_blank">' . $data->syarat_10 . '</a>';
            })
            // ->addColumn('select_all_syarat1', function ($data) {
            //     return '<a href="' . route('downloadPwk', $data->id) . '"><i class="fa fa-download"></i></a>';
            // })
            // ->addColumn('select_all_syarat2', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat2" value="' . $data->syarat_2 . '" />';
            // })
            // ->addColumn('select_all_syarat3', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat3" value="' . $data->syarat_3 . '" />';
            // })
            // ->addColumn('select_all_syarat4', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat4" value="' . $data->syarat_4 . '" />';
            // })
            // ->addColumn('select_all_syarat5', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat5" value="' . $data->syarat_5 . '" />';
            // })
            // ->addColumn('select_all_syarat6', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat6" value="' . $data->syarat_6 . '" />';
            // })
            // ->addColumn('select_all_syarat7', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat7" value="' . $data->syarat_7 . '" />';
            // })
            // ->addColumn('select_all_syarat8', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat8" value="' . $data->syarat_8 . '" />';
            // })
            // ->addColumn('select_all_syarat9', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat9" value="' . $data->syarat_9 . '" />';
            // })
            // ->addColumn('select_all_syarat10', function ($data) {
            //     return '<input type="checkbox" name="syarat[]" class="syarat10" value="' . $data->syarat_10 . '" />';
            // })
            ->rawColumns([
                'status',
                'syarat_1', 'syarat_2', 'syarat_3', 'syarat_4', 'syarat_5', 'syarat_6', 'syarat_7', 'syarat_8', 'syarat_9', 'syarat_10',
                // 'select_all_syarat1', 
                // 'select_all_syarat2',
                // 'select_all_syarat3',
                // 'select_all_syarat4',
                // 'select_all_syarat5',
                // 'select_all_syarat6',
                // 'select_all_syarat7',
                // 'select_all_syarat8',
                // 'select_all_syarat9',
                // 'select_all_syarat10',
            ])
            ->make(true);
    }

    public function downloadPwk($id)
    {
        for ($i = 1; $i <= 10; $i++) {
            $data = DaftarSeminar::pluck('syarat_' . $i)->where('id', $id)->toArray();
            // dd($data);
        }

        // $path='mahasiswa/seminar/'$data;
        // $files = $request->syarat;
        // $zip = new ZipArchive;
        // $fileName = 'sidang_pembahasan.zip';

        // if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
        //     foreach ($files as $file) {
        //         $path = File::files(asset('public/mahasiswa/seminar/' . $file));
        //         $relativeName = basename($path);
        //         $zip->addFile($path, $relativeName);
        //     }
        //     $zip->close();
        // }

        // return Response::download(public_path($fileName));
    }
}
