<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ApplicantLoginController extends Controller
{
    protected $redirectTo = '/applicant/dashboard';

    public function showLoginForm()
    {
        return Inertia::render('Applicant/Auth/Login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'control_number' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',

        ]);

        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'control_number' => 'required',
        //     'birthday' => 'required',
        // ]);

        $applicant = Applicant::where('email', $request->email)
            ->where('id', $request->control_number)
            ->where('birthday', $request->birthday)->first();

        // Auth::loginUsingId($applicant->id);

        // return redirect('/dashboard');

        // if ($validator->fails()) {
        //     return back()->withInput()->withErrors($validator);
        // } else {
        //     Auth::loginUsingId($applicant->id);
        //     return redirect('applicant/dashboard');
        //     // if (Auth::attempt($request->only(["id", "email", "birthday"]))) {
        //     //     return redirect("dashboard")->with('success', 'Login Successful');
        //     // } else {
        //     //     return back()->withErrors("Invalid credentials");
        //     // }
        // }
    }

    public function logout(Request $request)
    {
        $this->guard->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('applicant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
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
}
