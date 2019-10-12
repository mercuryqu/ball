<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\WebStatus;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends AdminBaseController
{
    use ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['index']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|max:16|alpha_dash'
        ]);

        if (Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return Redirect::intended(route('admin.home'))
                   ->with('code', WebStatus::LOGIN_SUCCESS_CODE)
                   ->with('success', WebStatus::LOGIN_SUCCESS_MESSAGE);
        }

        return Redirect::back()
               ->withInput()
               ->with('code', WebStatus::LOGIN_FAILED_CODE)
               ->with('danger', WebStatus::LOGIN_FAILED_MESSAGE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return Redirect::route('admin.auth.login')
            ->with('code', WebStatus::LOGOUT_SUCCESS_CODE)
            ->with('success', WebStatus::LOGOUT_SUCCESS_MESSAGE);
    }
}
