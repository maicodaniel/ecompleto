<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedidos_situacao extends Model
{
    use HasFactory;

    protected $table = 'pedido_situacao';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
