<?php

namespace RB28DETT\RB28DETT\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show login form.
     */
    public function show()
    {
        return view('rb28dett::pages.login');
    }

    /**
     * Manual user login.
     *
     * @param $request
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember ? true : false)) {
            return redirect()->intended(route('rb28dett::index'));
        }

        return redirect()->route('rb28dett::login')->with('error', trans('auth.failed'))->withInput();
    }
}
