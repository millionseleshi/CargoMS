<?php

namespace App\Http\Controllers\Forwarder;

use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class processpayment extends Controller
{
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
        $payment=Payment::where('status','unverified')->paginate(15);
        return view('forwarder.processpayment',compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator=Validator::make($request->all(),[
            'csvFile'=>'required|mimes:csv,txt'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
        {


                    $file = $request->file('csvFile');

                    $filename = $file->getClientOriginalName();

                    $location = 'BankingResponse';

                    $file->move($location, $filename);

                    $filepath = public_path($location . "/" . $filename);

                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE)
                    {
                        $num = count($filedata);
                        if($i == 0)
                        {
                           $i++;
                           continue;
                        }
                        for ($c = 0; $c < $num; $c++)
                        {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

            foreach($importData_arr as $importData)
            {
                $accountNumber=$importData[3];
                $paymentDate=$importData[4];
                $AWB=$importData[5];//Reason in csv
                $amountPaid=$importData[6];
                $receiptsId=$importData[8];
                Payment::where('AWB',$AWB)->update
                ([
                    'accountNumber'=>$accountNumber,
                    'amountPaid'=>$amountPaid,
                    'receiptsId'=>$receiptsId,
                    'paymentDate'=>$paymentDate
                ]);

                $amountExpected=Payment::where('AWB',$AWB)->value('amountExpected');
                $difference= $amountExpected-$amountPaid;
                if($difference<=0)
                {
                    Payment::where('AWB',$AWB)->update
                    ([
                        'status'=>'verified'
                    ]);
                }
            }
                }
                $payments=Payment::all();
        return view('forwarder.paymenttable',compact('payments'));
            //redirect()->back()->with('status','CSV loaded successfully');
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
