<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    //Show all Clients
    public function home()
    {
      $clients= Client::paginate(15);  
      return view('/pages/clients/home',compact('clients'));
    }
}
