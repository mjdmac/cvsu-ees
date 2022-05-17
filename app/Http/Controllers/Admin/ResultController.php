<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ResultMail;
use App\Models\Applicant;
use App\Models\Course;
use App\Models\Result;
use App\Models\User;
use App\Notifications\ResultNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class ResultController extends Controller
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
            'field' => ['in:applicant_id,name,exam,score,course,status'],
        ]);

        $course_names = Course::latest()->get();
        $applicant = DB::table('results')
        ->join('applicants', 'results.applicant_id', '=', 'applicants.id')
        ->where('results.applicant_id' , '=', 'applicants.id');

        $data = Result::query();
        $perpage = $request->input('perpage') ?: 25;

        if (request('search')) {
            $data
                ->orwhere('results.applicant_id', 'like', '%' . request('search') . '%')
                ->orWhere('results.name', 'like', '%' . request('search') . '%')
                ->orWhere('results.course', 'like', '%' . request('search') . '%')
                ->orWhere('results.status', 'like', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $data->orderBy(request('field'), request('direction'))->get();
        }

        return Inertia::render('Admin/Result/Index', [
            'results' => $data->paginate($perpage)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction', 'perpage']),
            'course_names' => $course_names,
            'applicant' => $applicant,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendNotification(Request $request)
    {
        $result = [
            'subject' => '',
            'greetings' => 'Good Day Applicant,',
            'body' => 'Congratulations! You passed the entrance examination and is qualified to enroll to Cavite State University-Main Campus. Proceed on submitting all the requirements for the enrollment.',
            'text' => 'See the results',
            'url' => url('/'),
            'thanks' => 'Thank you!',
        ];

        $basic  = new \Vonage\Client\Credentials\Basic("68ad8f1a", "4PMcuDQ5mVe0STkl");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("639072203266", BRAND_NAME, 'A text message sent using the Nexmo SMS API')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }

        // Notification::send($applicant, new ResultNotification($result));
        Mail::to("banogfires@gmail.com")->send(new ResultMail($result));

        dd('Result has been sent!');
    }
}
