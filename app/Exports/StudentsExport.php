<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(
        private ?string $search = null,
        private ?string $gender = null,
        private ?string $classId = null,
    ) {
    }

    public function collection()
    {
        $allowedClasses = [
            'Kelas 7',
            'Kelas 8',
            'Kelas 9',
        ];

        $query = Student::with(['user', 'schoolClass'])
            ->whereHas('schoolClass', function ($classQuery) use ($allowedClasses) {
                $classQuery->whereIn('name', $allowedClasses);
            });

        if ($this->search) {
            $search = $this->search;

            $query->where(function ($q) use ($search) {
                $q->where('nisn', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($this->gender) {
            $query->where('gender', $this->gender);
        }

        if ($this->classId) {
            $query->where('school_class_id', $this->classId);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'NISN',
            'Jenis Kelamin',
            'Kelas',
            'Alamat',
        ];
    }

    public function map($student): array
    {
        return [
            $student->user->name ?? '-',
            $student->user->email ?? '-',
            $student->nisn ?? '-',
            $student->gender === 'male' ? 'Laki-laki' : 'Perempuan',
            $student->schoolClass->name ?? '-',
            $student->address ?? '-',
        ];
    }
}