<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DosenImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'password' => bcrypt($row['nik']),
            'level' => 2,
            'program_studi' => $row['program_studi'],
            'tipe_dosen' => $row['tipe'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|unique:users',
            'nama' => 'required',
        ];
    }
}
