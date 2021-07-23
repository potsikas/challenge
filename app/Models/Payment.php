<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Payment extends Model
{
    use HasFactory;
    
    public function __construct($client=null,$payment=null)
    {
        if(!is_null($client) && !is_null($payment )){
            $this->user_id = trim($client);
            $this->amount = trim($payment);
        }
    }

    //Relationship : A payment has one user (one to many)
    public function client()
    {
        return $this->belongsTo(Client::class,'user_id');
    }

    //Get Last Payments
    static function getLastPayments($startDate,$endDate)
    {
      return Payment::whereBetween('created_at',[$startDate, $endDate])->orderByDesc('created_at')->get()->unique('user_id');
    }
    
    //Latest 30 days Payments
    static function getLast30Days($date)
    {
      return Payment::whereDate('created_at','>=',$date)->orderByDesc('created_at')->get()->unique('user_id');
    }
    

}

    