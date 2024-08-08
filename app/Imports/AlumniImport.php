<?php

namespace App\Imports;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\PersistRelations;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlumniImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    private $users;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $user = new User([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'password' => bcrypt($row['nik']),
            'level' => 3,
            'program_studi' => $row['program_studi'],
            'tahun_lulus' => $row['tahun_lulus'],
            'status_aktif' => 0
        ]);

        return $user;
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|unique:users',
            'nama' => 'required',
        ];
    }
}
