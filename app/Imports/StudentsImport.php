<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    private array $allowedClasses = [
        'Kelas 7',
        'Kelas 8',
        'Kelas 9',
    ];

    public function collection(Collection $rows)
    {
        $errors = [];

        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2;

            $name = trim((string) ($row['nama'] ?? ''));
            $email = trim((string) ($row['email'] ?? ''));
            $password = trim((string) ($row['password'] ?? ''));
            $nisn = trim((string) ($row['nisn'] ?? ''));
            $gender = $this->normalizeGender($row['jenis_kelamin'] ?? '');
            $className = $this->normalizeClass($row['kelas'] ?? '');
            $address = trim((string) ($row['alamat'] ?? ''));

            if ($name === '') {
                $errors[] = "Baris {$rowNumber}: nama wajib diisi.";
            }

            if ($email === '') {
                $errors[] = "Baris {$rowNumber}: email wajib diisi.";
            }

            if ($email !== '' && ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Baris {$rowNumber}: format email tidak valid.";
            }

            if ($gender === null) {
                $errors[] = "Baris {$rowNumber}: jenis kelamin harus Laki-laki/Perempuan atau male/female.";
            }

            if ($className === null) {
                $errors[] = "Baris {$rowNumber}: kelas harus 7, 8, 9, Kelas 7, Kelas 8, atau Kelas 9.";
            }

            if (! empty($errors)) {
                continue;
            }

            DB::transaction(function () use ($name, $email, $password, $nisn, $gender, $className, $address) {
                $schoolClass = SchoolClass::firstOrCreate([
                    'name' => $className,
                ]);

                $user = User::where('email', $email)->first();

                if (! $user) {
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'password' => Hash::make($password !== '' ? $password : 'password123'),
                    ]);
                } else {
                    $userData = [
                        'name' => $name,
                    ];

                    if ($password !== '') {
                        $userData['password'] = Hash::make($password);
                    }

                    $user->update($userData);
                }

                $studentRole = Role::where('name', 'siswa')->first();

                if ($studentRole) {
                    $user->roles()->syncWithoutDetaching([$studentRole->id]);
                }

                Student::updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'nisn' => $nisn !== ''
                            ? $nisn
                            : 'NISN-' . Str::upper(Str::random(8)),
                        'school_class_id' => $schoolClass->id,
                        'gender' => $gender,
                        'address' => $address,
                    ]
                );
            });
        }

        if (! empty($errors)) {
            throw ValidationException::withMessages([
                'file' => $errors,
            ]);
        }
    }

    private function normalizeGender($value): ?string
    {
        $value = strtolower(trim((string) $value));

        return match ($value) {
            'male', 'laki-laki', 'laki laki', 'l', 'pria' => 'male',
            'female', 'perempuan', 'p', 'wanita' => 'female',
            default => null,
        };
    }

    private function normalizeClass($value): ?string
    {
        $value = strtolower(trim((string) $value));
        $value = str_replace(['kelas', 'class'], '', $value);
        $value = trim($value);

        return match ($value) {
            '7', 'vii' => 'Kelas 7',
            '8', 'viii' => 'Kelas 8',
            '9', 'ix' => 'Kelas 9',
            default => null,
        };
    }
}