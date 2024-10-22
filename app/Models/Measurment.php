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

/*Measurements*/
}

/* CREATE TABLE Measurment ( */
/*     ID_Measurment CHAR(8) PRIMARY KEY, */
/*     Measurement_Time TIMESTAMP, */
/*     Measurement_Value DECIMAL(10,2), */
/*     Compression_Level int, */
/*     ID_Station char(4) REFERENCES Station(ID_Station), */
/*     ID_Measured_Unit INT REFERENCES Measured_Unit(ID_Measured_Unit) */
/* ); */
