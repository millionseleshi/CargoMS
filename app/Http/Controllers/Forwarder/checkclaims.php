<?php

namespace App\Http\Controllers\Forwarder;

use App\Claims;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class checkclaims extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $irregularity=['loss'=>'Loss','damage'=>'Damage','pilferage'=>'Pilferage','dead'=>'Dead','sickOrInjured'=>'Sick Or Injured','other'=>'Other'];
         $claims=Claims::where('status','=','unprocessed')->paginate(15);
        return view('forwarder.checkclaims',compact('claims','irregularity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $claimsID=$request['claimId'];

          Claims::where('id',$claimsID)->update(['status'=>'settled']);

          //TODO send notification of claim settlement

          return redirect()->back()->with('status','Claim Settled') ;
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
