<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gateways extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $timestamps = false;
}
