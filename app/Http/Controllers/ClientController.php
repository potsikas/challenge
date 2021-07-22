<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    //Show all Clients
    public function home()
    {
      $clients= Client::paginate(5);  
      return view('/pages/clients/home',compact('clients'));
    }

    //Save new Client
    public function new(Request $request)
    {
      
      //Get user inputs to var
      $name= trim(strtoupper($request->name));
      $surname= trim(strtoupper($request->surname));
      
      //Check if are empty
      if(empty($name) || empty($surname)){
        $msg = ['message' => 'You have to fill all fields.','type' => 'danger'];
        return view('messages.message')->with(compact('msg'));
      }

      //save new client data
      try{
        $client = new Client($name, $surname);
        $client->timestamp;
        $client->save();
        $msg = ['message' => 'New client added! ','type' => 'success'];
        echo "<script>setTimeout(function(){ window.location = '".$request->headers->get('referer')."'; }, 2000);</script>";
        return view('messages.message')->with(compact('msg'));
      }catch(\Exception $e){
        $msg = ['message' => 'Error: '.$e->getMessage(),'type' => 'danger'];
        return view('messages.message')->with(compact('msg'));
     }
    
    }
}
