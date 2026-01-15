<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function foto()
    {
        $user = auth()->user();

        abort_if(!$user->foto, 404);

        return response()->file(
            storage_path('app/' . $user->foto)
        );
    }

    public function userFoto($id)
    {
        $data = User::find($id);

        abort_if(!$data->foto, 404);

        return response()->file(
            storage_path('app/' . $data->foto)
        );
    }

    public function buktiFisikSkkft($id)
    {
        $data = Kegiatan::find($id);

        abort_if(!$data->bukti_fisik, 404);

        return response()->file(
            storage_path('app/' . $data->bukti_fisik)
        );

        // $data = Kegiatan::findOrFail($id);

        // abort_if(!$data->bukti_fisik, 404);

        // // Cek file benar-benar ada di storage
        // if (!Storage::exists($data->bukti_fisik)) {
        //     abort(404, 'File bukti fisik tidak ditemukan');
        // }

        // return response()->file(
        //     storage_path('app/' . $data->bukti_fisik)
        // );
    }
}
