<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    
    protected $fillable  = ['name','surname'];

    public function __construct($name=null,$surname=null)
    {
        if(!is_null($name) && !is_null($surname)){
            $this->name = trim(ucfirst(strtolower(($name))));
            $this->surname = trim(ucfirst(strtolower(($surname))));
        }
    }

 
    //Relationship : A client has many payments (one to many)
    public function payments()
    {
        return $this->hasMany(Payment::class,'user_id');
    }

    public function total()
    {
        return $this->hasMany(Payment::class,'user_id')->sum('amount');
    }
 }
