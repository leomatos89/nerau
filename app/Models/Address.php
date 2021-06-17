<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = "addresses";
    public $timestamps = true;
    protected $fillable = ['cep','localidade','logradouro','complemento','bairro','uf','id_client'];

}
