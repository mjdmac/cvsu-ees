<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Traits\Banner;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ApplicantUpdateController extends Controller
{
    use Banner;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authApplicant = auth()->user()->id;
        $applicant = Applicant::where('user_id', $authApplicant)->first();

        return Inertia::render('Applicant/Profile/Show', [
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

    public function updatePersonal(Request $request, Applicant $applicant)
    {
        $val = Validator::make($request->all(), [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }
        
        $authApplicant = auth()->user()->id;
        $applicant = Applicant::where('user_id', $authApplicant)->first();

        $applicant->update([
            'fname' => Str::of($request['fname'])->ucfirst(),
            'mname' => Str::of($request['mname'])->ucfirst(),
            'lname' => Str::of($request['lname'])->ucfirst(),
        ]);
        // dd($user);

        $user = User::where('id', $request['id'])->first();

        $user->update([
            'name' =>  Str::of($request['lname'])->ucfirst() . ', ' . Str::of($request['fname'])->ucfirst() . ' ' . Str::of($request['mname'])->ucfirst(),
        ]);

        $this->flash('Personal information updated.', 'success');

        return redirect()->back();
    }

    public function updateProfile(Request $request, Applicant $applicant)
    {
        $val = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'integer', 'regex:/^(63)[0-9]{10}$/'],
            'birthday' => ['required', 'date'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }
        
        $authApplicant = auth()->user()->id;
        $applicant = Applicant::where('user_id', $authApplicant)->first();

        $applicant->update([
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'birthday' => $request['birthday'],
        ]);

        $user = User::where('id', $request['id'])->first();

        $user->update([
            'email' => $request['email'],
            'phone' => $request['phone_number'],
        ]);

        $this->flash('Profile information updated.', 'success');

        return redirect()->back();
    }
}
