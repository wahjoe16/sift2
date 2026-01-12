<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
