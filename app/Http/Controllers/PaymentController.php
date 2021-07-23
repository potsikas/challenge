<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Client;
use Artisan;

class PaymentController extends Controller
{
    //check payment data inputs
    public function emptyData($client,$payment)
    {
        $client = trim($client);
        $payment = trim($payment);
        
        //Check if are empty
        $return = (empty($client) || empty($payment)) ? TRUE : FALSE ;
        return $return;
    }

    //Show all Payments
     public function home()
     {

       return Artisan::call('payments:csv');

       $payments = Payment::with('client')->paginate(5);  
      
       $clients = Client::orderBy('surname')->get();  
       return view('/pages/payments/home',compact('payments','clients'));
     }

    //Save new Payment
    public function new(Request $request)
    {
        //Check for empty data
        if($this->emptyData($request->client, $request->payment)){
            $msg = ['message' => 'You have to fill all fields.','type' => 'danger'];
            return view('messages.message')->with(compact('msg'));
        }
        //Check for payment value - must be integer
        if(!ctype_digit(trim($request->payment))){
            $msg = ['message' => 'Payment field must be an integer.','type' => 'danger'];
            return view('messages.message')->with(compact('msg'));
        }

        //save new payment
        try{
            $payment = new Payment($request->client, $request->payment);
            $payment->timestamps;
            $payment->save();
            $msg = ['message' => 'New Payment added! ','type' => 'success'];
            echo "<script>setTimeout(function(){ window.location = '".$request->headers->get('referer')."'; }, 2000);</script>";
            return view('messages.message')->with(compact('msg'));
        }catch(\Exception $e){
            $msg = ['message' => 'Error: '.$e->getMessage(),'type' => 'danger'];
            return view('messages.message')->with(compact('msg'));
        }
    
    }

     //Edit Payment
    public function edit(Request $request,$id)
    {
        //Check for empty data
        if($this->emptyData($request->client, $request->payment)){
            $msg = ['message' => 'You have to fill all fields.','type' => 'danger'];
            return view('messages.message')->with(compact('msg'));
        }
        //Check for payment value - must be integer
        if(!ctype_digit(trim($request->payment))){
            $msg = ['message' => 'Payment field must be an integer.','type' => 'danger'];
            return view('messages.message')->with(compact('msg'));
        }

        //save changes
        try{
            $payment = Payment::find($id);
            $payment->amount = trim($request->payment);
            $payment->touch();
            $payment->save();
            $msg = ['message' => 'Changes were successfully saved! ','type' => 'success'];
            echo "<script>setTimeout(function(){ window.location = '".$request->headers->get('referer')."'; }, 2000);</script>";
            return view('messages.message')->with(compact('msg'));
        }catch(\Exception $e){
            $msg = ['message' => 'Error: '.$e->getMessage(),'type' => 'danger'];
            return view('messages.message')->with(compact('msg'));
        }
    }

    //Delete Payment
    public function delete($id)
    {    
        //delete data
        try{
            $payment = Payment::find($id);
            $payment->delete();
            $msg = ['message' => 'Payment was successfully  deleted! ','type' => 'success'];
            return back()->with(compact('msg'));
        }catch(\Exception $e){
            $msg = ['message' => 'Error: '.$e->getMessage(),'type' => 'danger'];
            return view('messages.message')->with(compact('msg'));
        }
    
    }

    //Latest Payments

    public function latestPayments(Request $request)
    {
       if(empty($request->startDate) || empty($request->endDate)){
            $msg = ['message' => 'You have to fill both date fields','type' => 'danger'];
            return back()->with(compact('msg'));
       }
       $startDate=Carbon::createFromFormat('d/m/Y',$request->startDate);
       $endDate=Carbon::createFromFormat('d/m/Y',$request->endDate);

       //startDate can't be greater than endDate
       if($startDate->gt($endDate)){
            $msg = ['message' => 'Start date can not be greater than End date','type' => 'danger'];
            return back()->with(compact('msg'))->withInput();
       }
       //GetData
       $records=Payment::getLastPayments($startDate,$endDate);
       //There are no records
       if(count($records)==0){
        $msg = ['message' => 'There are no records for these dates..','type' => 'warning'];
        return back()->with(compact('msg'))->withInput();
       }
       return view('pages/payments/latest', compact('records','startDate','endDate'));
    }
   

    
}
