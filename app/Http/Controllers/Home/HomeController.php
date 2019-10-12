<?php

namespace App\Http\Controllers\Home;

use App\Helpers\CheckMobile;
use Illuminate\Http\Request;

class HomeController extends HomeBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect()->route('wap.home');
    }
}
