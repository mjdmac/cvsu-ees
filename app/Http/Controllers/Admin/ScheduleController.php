<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Exam;
use App\Models\Schedule;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:course_name,course_desc'],
        ]);

        $exam_subjects = Exam::latest()->get();
        $colleges = College::latest()->get();
        $perpage = $request->input('perpage') ?: 25;

        $data = Schedule::with('exams')
            ->with('colleges')
            ->select(\DB::raw('*'));

        if (request('search')) {
            $data
                ->join('colleges', 'schedule.college_id', '=', 'colleges.id')
                ->where('schedule.start_date', 'like', '%' . request('search') . '%')
                ->orwhere('schedule.end_date', 'like', '%' . request('search') . '%')
                ->orwhere('colleges.college_name', 'like', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $data->orderBy(request('field'), request('direction'))->get();
        }

        return Inertia::render('Admin/Schedule/Index', [
            'exam_subjects' => $exam_subjects,
            'colleges' => $colleges,
            'schedules' => $data->paginate($perpage)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction', 'perpage']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request['colleges']);
        $val = Validator::make($request->all(), [
            'college' => ['required'],
            'exams' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        $sched_code = IdGenerator::generate(['table' => 'schedules', 'field' => 'sched_code', 'length' => 8, 'prefix' => 'SCH-', 'reset_on_prefix_change' => true]);

        $schedule = Schedule::create([
            'sched_code' => $sched_code,
            'college_id' => $request['college'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
        ]);


        $examids = [];
        foreach ($request['exams'] as $exam) {
            array_push($examids, $exam['id']);
        }
        $schedule->exams()->attach($examids);

        $this->flash('Schedule created', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
