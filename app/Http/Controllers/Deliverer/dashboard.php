<?php

namespace App\Http\Controllers\Deliverer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('deliverer.dashboard');
    }


}
