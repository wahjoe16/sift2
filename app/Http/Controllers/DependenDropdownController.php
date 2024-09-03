<?php

namespace App\Http\Controllers;

use App\Models\PoinSkkft;
use App\Models\SubcategorySkkft;
use Illuminate\Http\Request;

class DependenDropdownController extends Controller
{
    public function getDataSubCategory($id)
    {
        $data = SubcategorySkkft::where('category_id', $id)->pluck('subcategory_name', 'id');
        return response()->json($data);
    }

    public function getDataTingkat($id)
    {
        $data = PoinSkkft::where('subcategory_id', $id)->with('tingkat_skkft')->get();
        return response($data);
    }

    public function getDataPrestasi($id)
    {
        $data = PoinSkkft::where('subcategory_id', $id)->with('prestasi_skkft')->get();
        return response($data);
    }

    public function getDataJabatan($id)
    {
        $data = PoinSkkft::where('subcategory_id', $id)->with('jabatan_skkft')->get();
        return response($data);
    }
}
