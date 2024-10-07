<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    use HasFactory;
    protected $table = 'station';
    protected $primaryKey = 'id_station';
    protected $keyType = 'string';

    public function mqtt_servers():BelongsTo
    {
        return $this->belongsTo(MQTTServers::class,"id_server","id_server");
    }
}
