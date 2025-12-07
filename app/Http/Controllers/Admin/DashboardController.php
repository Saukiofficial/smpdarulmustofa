<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Post;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $postCount = Post::count();
        $teacherCount = Teacher::count();
        $studentCount = Student::count();
        $pendingAdmissionCount = Admission::where('status', 'pending')->count();

 

     
        $allStudents = Student::with('schoolClass:id,name')->select('id', 'school_class_id', 'gender')->get()
            ->map(function ($student) {
                return [
                    'id' => $student->id,
                    'classroom' => $student->schoolClass->name ?? 'Tanpa Kelas', 
                    'gender' => $student->gender,
                ];
            });


        $classrooms = $allStudents->pluck('classroom')->unique()->sort()->values();


        $genderStats = $allStudents->countBy('gender');

        $maleCount = $genderStats->get('Laki-laki', 0);
        $femaleCount = $genderStats->get('Perempuan', 0);

        return view('pages.admin.dashboard', [
            'postCount' => $postCount,
            'teacherCount' => $teacherCount,
            'studentCount' => $studentCount,
            'pendingAdmissionCount' => $pendingAdmissionCount,
            'allStudents' => $allStudents,
            'classrooms' => $classrooms,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
        ]);
    }
}
