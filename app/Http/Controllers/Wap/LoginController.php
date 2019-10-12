<?php

namespace App\Http\Controllers\Wap;

use App\Helpers\HelperStatus;
use App\Models\Member;
use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends WapBaseController
{
    /**
     * Define a new resource var
     * @var $member
     * @var $sms
     */
    protected $member;
    protected $sms;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\Sms  $sms
     * @param  \App\Models\Member  $member
     */
    public function __construct(Member $member, Sms $sms)
    {
        $this->member = $member;
        $this->sms = $sms;

        // Only no login member visit pages
        $this->middleware('wap.guest', [
            'only' => ['index', 'login', 'verification']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wap.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'telephone' => 'required|string|size:11|regex:'.config('custom.telephone_regex'),
                'code' => 'required|string|size:6',
            ]);

            $telephone = $request->input('telephone');
            $code = $request->input('code');
            $auth = $this->sms->telephoneCodeAuthentication($telephone, $code);

            if ($auth === 'no_code') {
                return $this->apiShow(HelperStatus::CODE_NOT_FOUND_FAILED_CODE, HelperStatus::CODE_NOT_FOUND_FAILED_MESSAGE);
            } elseif ($auth === 'code_exception') {
                return $this->apiShow(HelperStatus::CODE_EXCEPTION_FAILED_CODE, HelperStatus::CODE_EXCEPTION_FAILED_MESSAGE);
            } elseif ($auth === 'code_is_used') {
                return $this->apiShow(HelperStatus::CODE_IS_USED_FAILED_CODE, HelperStatus::CODE_IS_USED_FAILED_MESSAGE);
            } elseif ($auth === 'code_is_expired') {
                return $this->apiShow(HelperStatus::CODE_IS_EXPIRED_FAILED_CODE, HelperStatus::CODE_IS_EXPIRED_FAILED_MESSAGE);
            } elseif ($auth === 'success') {
                $login_status = $this->member->checkLoginOrRegister($telephone);
                if ($login_status === 'normal' || $login_status === 'register_success') {
                    $member = $this->member->where('telephone', $telephone)->first();
                    $request->session()->put('member', $member);
                    $data = ['redirect_url' => route('wap.members.show')];
                    return $this->apiShow(HelperStatus::LOGIN_SUCCESS_CODE, HelperStatus::LOGIN_SUCCESS_MESSAGE, $data);
                }
            }

            return $this->apiShow(HelperStatus::LOGIN_FAILED_CODE, HelperStatus::LOGIN_FAILED_MESSAGE);
        }
    }

    /**
     * Verification input form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function verification(Request $request)
    {
        $this->validate($request, [
            'telephone' => 'required|string|size:11|regex:'.config('custom.telephone_regex')
        ]);

        $telephone = $request->input('telephone');
        return view('wap.auth.verification', compact('telephone'));
    }
}
