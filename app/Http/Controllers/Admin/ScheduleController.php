<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Banner;
use App\Models\Applicant;
use App\Models\College;
use App\Models\Exam;
use App\Models\Schedule;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ScheduleController extends Controller
{

    use Banner;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:sched_code,start_date,end_date,start_ctrl_num,end_ctrl_num,status'],
        ]);

        $sched =  Schedule::where('status', 'pending')->get();
        $arr = [];

        foreach($sched as $num){
            for($x=$num->start_ctrl_num;$x<=$num->end_ctrl_num;$x++){
                if(!in_array($x, $arr))
                    array_push($arr, $x);
            }
        }


        // $end_num = Schedule::pluck('end_ctrl_num')
        //                     ->toArray();

        $applicants = Applicant::select('id')
            ->whereNotIn('id', $arr)
            ->latest()
            ->get();

        $perpage = $request->input('perpage') ?: 25;

        $data = Schedule::query();

        if (request('search')) {
            $data
                ->where('schedules.sched_code', 'like', '%' . request('search') . '%')
                ->orwhere('schedules.sched_name', 'like', '%' . request('search') . '%')
                ->orwhere('schedules.start_date', 'like', '%' . request('search') . '%')
                ->orwhere('schedules.end_date', 'like', '%' . request('search') . '%')
                ->orwhere('schedules.start_ctrl_num', 'like', '%' . request('search') . '%')
                ->orwhere('schedules.end_ctrl_num', 'like', '%' . request('search') . '%')
                ->orwhere('schedules.status', 'like', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $data->orderBy(request('field'), request('direction'))->get();
        }

        return Inertia::render('Admin/Schedule/Index', [
            'schedules' => $data->paginate($perpage)->withQueryString(),
            'applicants' => $applicants,
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
            'sched_name' => ['required'],
            'start_ctrl_num' => ['required'],
            'end_ctrl_num' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        $sched_code = IdGenerator::generate(['table' => 'schedules', 'field' => 'sched_code', 'length' => 8, 'prefix' => 'SCH-', 'reset_on_prefix_change' => true]);

        Schedule::create([
            'sched_code' => $sched_code,
            'sched_name' => $request['sched_name'],
            'start_ctrl_num' => $request['start_ctrl_num'],
            'end_ctrl_num' => $request['end_ctrl_num'],
            'start_date' => date('Y-m-d H:i:s', strtotime($request['start_date'])),
            'end_date' => date('Y-m-d H:i:s', strtotime($request['end_date'])),
        ]);

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
