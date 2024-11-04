<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeasuredUnit extends Model
{

    use HasFactory;
    protected $table = 'measured_unit';

    public function optimal_value():HasMany
    {
        return $this->hasMany(OptimalValue::class, 'id_measured_unit', 'id_measured_unit');
    }
}
