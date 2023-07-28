<?php

namespace App\Exports;

use App\Models\DaftarSidang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapLulusanExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DaftarSidang::with([
            'mahasiswa',
            'tahun_ajaran',
            'semester',
            'dosen_1',
            'dosen_2'
        ])->where(['status' => 1])->orderBy('tahun_ajaran_id', 'ASC')->get();

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Mahasiswa',
            'NPM',
            'Program Studi',
            'Tahun Akademik',
            'Semester',
            'Dosen Pembimbing 1',
            'Dosen Pembimbing 2',
            'Judul Skripsi',
            'Tanggal Pengajuan'
        ];
    }

    public function map($row): array
    {
        return [
            $row->mahasiswa->nama,
            $row->mahasiswa->nik,
            $row->program_studi_id,
            $row->tahun_ajaran->tahun_ajaran,
            $row->semester->semester,
            $row->dosen_1->nama,
            $row->dosen_2->nama,
            $row->judul_skripsi,
            tanggal_indonesia($row->created_at),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => 'true']]
        ];
    }
}
