<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    //check client data inputs
    public function emptyData($name,$surname)
    {
      $name= trim($name);
      $surname= trim($surname);
      
      //Check if are empty
      $return = (empty($name) || empty($surname)) ? TRUE : FALSE ;
      return $return;
    }


    //Show all Clients
    public function home()
    {
      $clients= Client::paginate(5);  
      return view('/pages/clients/home',compact('clients'));
    }

    //Save new Client
    public function new(Request $request)
    {
      //Check for empty data
      if($this->emptyData($request->name, $request->surname)){
        $msg = ['message' => 'You have to fill all fields.','type' => 'danger'];
        return view('messages.message')->with(compact('msg'));
      }
      //save new client data
      try{
        $client = new Client($request->name, $request->surname);
        $client->timestamps;
        $client->save();
        $msg = ['message' => 'New client added! ','type' => 'success'];
        echo "<script>setTimeout(function(){ window.location = '".$request->headers->get('referer')."'; }, 2000);</script>";
        return view('messages.message')->with(compact('msg'));
      }catch(\Exception $e){
        $msg = ['message' => 'Error: '.$e->getMessage(),'type' => 'danger'];
        return view('messages.message')->with(compact('msg'));
     }
    
    }

    //Edit Client
    public function edit(Request $request,$id)
    {
     
      //Check for empty data
      if($this->emptyData($request->name, $request->surname)){
        $msg = ['message' => 'You have to fill all fields.','type' => 'danger'];
        return view('messages.message')->with(compact('msg'));
      }

      //save changes
      try{
        $client = Client::find($id);
        $client->name = trim(ucfirst(strtolower(($request->name))));
        $client->surname = trim(ucfirst(strtolower(($request->surname))));
        $client->touch();
        $client->save();
        $msg = ['message' => 'Changes were successfully saved! ','type' => 'success'];
        echo "<script>setTimeout(function(){ window.location = '".$request->headers->get('referer')."'; }, 2000);</script>";
        return view('messages.message')->with(compact('msg'));
      }catch(\Exception $e){
        $msg = ['message' => 'Error: '.$e->getMessage(),'type' => 'danger'];
        return view('messages.message')->with(compact('msg'));
     }
    
    }

    //Delete Client
    public function delete($id)
    {    
        //delete data
        try{
          $client = Client::find($id);
          $client->delete();
          $msg = ['message' => 'Client was successfully  deleted! ','type' => 'success'];
          return back()->with(compact('msg'));
        }catch(\Exception $e){
          $msg = ['message' => 'Error: '.$e->getMessage(),'type' => 'danger'];
          return view('messages.message')->with(compact('msg'));
      }
    
    }

}
