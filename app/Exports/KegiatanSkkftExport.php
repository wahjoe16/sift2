<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KegiatanSkkftExport implements FromCollection, WithHeadings, WithMapping, WithStyles

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Kegiatan::with([
            'user_skkft', 
            'categories_skkft', 
            'subcategories_skkft', 
            'tingkat_skkft', 
            'prestasi_skkft', 
            'jabatan_skkft'
        ])->where('status_skkft', 1)->orderBy('id', 'DESC')->get();

        return $data;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Mahasiswa',
            'NPM',
            'Nama Kegiatan',
            'Tanggal Kegiatan',
            'Kategori',
            'Subkategori',
            'Tingkat',
            'Prestasi',
            'Jabatan',
            'Bukti Fisik',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->user_skkft->nama ?? '-',
            $row->user_skkft->nik ?? '-',
            $row->nama_kegiatan,
            tanggal_indonesia($row->tanggal, false),
            $row->categories_skkft->category_name ?? '-',
            $row->subcategories_skkft->subcategory_name ?? '-',
            $row->tingkat_skkft->tingkat ?? '-',
            $row->prestasi_skkft->prestasi ?? '-',
            $row->jabatan_skkft->jabatan ?? '-',
            $row->bukti_fisik ? url('/mahasiswa/skkft/' . $row->bukti_fisik) : 'Tidak ada bukti fisik',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Define styles for the header row
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}
