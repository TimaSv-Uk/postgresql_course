<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class OptimalValue extends Model
{
    use HasFactory;

    protected $table = 'optimal_value';

    public $incrementing = false;
    protected $primaryKey = ['id_category', 'id_measured_unit'];
    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function measured_unit():BelongsTo
    {
        return $this->belongsTo(MeasuredUnit::class, 'id_measured_unit', 'id_measured_unit');
    }
}
