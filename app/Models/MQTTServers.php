<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MQTTServers extends Model
{
    use HasFactory;
    protected $table = 'mqtt_server';
    protected $primaryKey = 'id_server';
    protected $keyType = 'string';
}
