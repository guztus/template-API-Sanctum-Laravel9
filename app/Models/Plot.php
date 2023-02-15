<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plot extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'cadastre_sign',
        'total_area',
        'measurement_date',
        'usage'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
