<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinates extends Model
{

    use HasFactory;
    protected $primaryKey = 'id_coordinates';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'coordinates';
}
