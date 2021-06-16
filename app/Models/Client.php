<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients";
    public $timestamps = true;
    protected $fillable = ['name','cpf','email','phone','id_address'];

}
