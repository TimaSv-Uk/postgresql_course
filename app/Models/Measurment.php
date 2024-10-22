<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurment extends Model
{

    use HasFactory;
    protected $table = 'measurment';
    protected $primaryKey = 'id_station';
    protected $keyType = 'string';

    public function station():BelongsTo
    {
        return $this->belongsTo(Station::class, 'id_station', 'id_station');
    }

    public function measured_unit():BelongsTo
    {
        return $this->belongsTo(MeasuredUnit::class, 'id_measured_unit', 'id_measured_unit');
    }

}
