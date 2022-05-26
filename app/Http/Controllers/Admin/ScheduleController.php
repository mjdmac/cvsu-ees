<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Banner;
use App\Mail\ScheduleMail;
use App\Models\Applicant;
use App\Models\College;
use App\Models\Exam;
use App\Models\Schedule;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

    public function __construct()
    {
        $this->authorizeResource(Schedule::class);
    }

    public function index(Request $request)
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:sched_code,date,ctrl_num,status'],
        ]);

        $sched =  Schedule::where('status', 'pending')->get();

        $arr = [];

        foreach ($sched as $num) {
            for ($x = $num->applicant_id; $x <= $num->applicant_id; $x++) {
                if (!in_array($x, $arr))
                    array_push($arr, $x);
            }
        }

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
                ->orwhere('schedules.date', 'like', '%' . request('search') . '%')
                ->orwhere('schedules.applicant_id', 'like', '%' . request('search') . '%')
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

        $val = Validator::make($request->all(), [
            'sched_name' => ['required'],
            'start_ctrl_num' => ['required'],
            'end_ctrl_num' => ['required'],
            'date' => ['required', 'date'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        $sched_code = IdGenerator::generate(['table' => 'schedules', 'field' => 'sched_code', 'length' => 8, 'prefix' => 'SCH-', 'reset_on_prefix_change' => true]);

        $arr = [];
        for ($x = $request->start_ctrl_num; $x <= $request->end_ctrl_num; $x++) {

            if (!in_array($x, $arr)) {
                array_push($arr, $x);
            }

            Schedule::create([
                'sched_code' => $sched_code,
                'sched_name' => $request['sched_name'],
                'applicant_id' => $x,
                'date' => date('Y-m-d H:i:s', strtotime($request['date'])),
            ]);
        }

        // EMAIL
        $data = [
            'name' => $request['name'],
            'status' => $request['status'],
            'course' => $request['course'],
            'regards' => 'Cavite State University-Main Campus',
        ];

        $this->flash('Schedule created!', 'success');

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


    public function sendNotification(Request $request)
    {
        $applicants = \DB::table('schedules')
            ->join('applicants', 'schedules.applicant_id', '=', 'applicants.id')
            ->select(
                'applicants.id',
                'applicants.fname',
                'applicants.mname',
                'applicants.lname',
                'applicants.email',
                'applicants.phone_number',
                'schedules.sched_name',
                'schedules.date'
            )
            ->where('schedules.status', '=', 'pending')
            ->get();

        // dd($applicants);

        if (count($applicants) < 1) {
            $this->flash('No pending schdules.', 'danger');
            return redirect()->back();
        } elseif (count($applicants) > 0) {
            foreach ($applicants as $applicant) {
                $data = [
                    'ctrl_num' => $applicant->id,
                    'name' => $applicant->lname . ', ' . $applicant->fname . ' ' . $applicant->mname,
                    'email' => $applicant->email,
                    'phone_number' => $applicant->phone_number,
                    'sched_name' => $applicant->sched_name,
                    'date' => $applicant->date,
                    'regards' => 'Cavite State University-Main Campus',
                ];

                Mail::to($applicant->email)->send(new ScheduleMail($data));
            }

            $this->flash('Schedule sent!', 'success');

            return redirect()->back();
        }
    }
}
