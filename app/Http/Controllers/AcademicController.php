<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\AcademicCalendar;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AcademicController extends Controller
{

    public function schedule(Request $request)
    {
        $classes = SchoolClass::all();
        $schedules = collect();

        if ($request->has('class_id')) {
            $schedules = Schedule::where('school_class_id', $request->class_id)
                ->with(['subject', 'teacher.user'])
                ->orderBy('day_of_week')
                ->orderBy('start_time')
                ->get()
                ->groupBy('day_of_week');
        }

        return view('pages.frontend.academic.schedule', compact('classes', 'schedules'));
    }


    public function calendar()
    {
        $events = AcademicCalendar::latest()->get();


        $totalEvents = $events->count();
        $examCount = $events->filter(function ($event) {
            return Str::contains(strtolower($event->title), ['uts', 'uas', 'ujian']);
        })->count();
        $holidayCount = $events->filter(function ($event) {
            return Str::contains(strtolower($event->title), 'libur');
        })->count();
        $nationalDayCount = $events->filter(function ($event) {
            return Str::contains(strtolower($event->title), ['peringatan', 'upacara', 'hut']);
        })->count();

        return view('pages.frontend.academic.calendar', compact(
            'events',
            'totalEvents',
            'examCount',
            'holidayCount',
            'nationalDayCount'
        ));
    }
}
