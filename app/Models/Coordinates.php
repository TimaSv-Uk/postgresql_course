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

    public function getLon(): ?float
    {
        $parced_coordinates = $this->parseLonLat();
        return $parced_coordinates['lon'];
    }

    public function getLat(): ?float
    {
        $parced_coordinates = $this->parseLonLat();
        return $parced_coordinates['lat'];
    }
    public function parseLonLat()
    {
        if (empty($this->lonlat)) {
            return ['lon' => null, 'lat' => null];
        }

        $trimed_semicol = trim($this->lonlat, "()");

        $parce_semicol_lon_lat = explode(",", $trimed_semicol);

        if (count($parce_semicol_lon_lat) != 2) {
            return ['lon' => null, 'lat' => null];
        }

        $lon = (float) $parce_semicol_lon_lat[0];
        $lat = (float) $parce_semicol_lon_lat[1];

        return [
            'lon' => $lon,
            'lat' => $lat,
        ];
    }
}
