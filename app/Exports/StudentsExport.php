<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Student::with(['user', 'schoolClass'])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Jenis Kelamin',
            'Kelas',
            'Jurusan',
        ];
    }

    public function map($student): array
    {
        return [
            $student->user->name,
            $student->gender == 'male' ? 'Laki-laki' : 'Perempuan',
            $student->schoolClass->name,
            $student->jurusan,
        ];
    }
}
