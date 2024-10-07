<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteStation extends Model
{

    use HasFactory;
    protected $table = 'favorite_station';
    protected $primaryKey = ['id_user','id_station'];
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'id_station', 'id_station');
    }
}
