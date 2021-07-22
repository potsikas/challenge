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
        $this->name = $name;
        $this->surname = $surname;
    }
 }
