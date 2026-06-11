<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsTemplateExport implements FromArray, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'nama',
            'email',
            'password',
            'nisn',
            'jenis_kelamin',
            'kelas',
            'alamat',
        ];
    }

    public function array(): array
    {
        return [
            [
                'Ahmad Rizki',
                'ahmad@example.com',
                'password123',
                '1234567890',
                'Laki-laki',
                'Kelas 7',
                'Jl. Contoh No. 1',
            ],
            [
                'Siti Aminah',
                'siti@example.com',
                'password123',
                '1234567891',
                'Perempuan',
                'Kelas 8',
                'Jl. Contoh No. 2',
            ],
            [
                'Budi Santoso',
                'budi@example.com',
                'password123',
                '1234567892',
                'Laki-laki',
                'Kelas 9',
                'Jl. Contoh No. 3',
            ],
        ];
    }
}