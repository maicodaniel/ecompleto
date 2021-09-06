<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lojas_gateways extends Model
{
    use HasFactory;

    protected $table = 'lojas_gateway';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
