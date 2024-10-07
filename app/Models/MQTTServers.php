<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MQTTServers extends Model
{
    protected $table = 'mqtt_servers';
    use HasFactory;
}
