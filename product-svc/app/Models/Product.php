<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'origin',
        'stock',
        'description'
    ];
    public $incrementing = false; //UUID is not auto increment
    protected $keyType = 'string';
}
