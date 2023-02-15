<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'persons_id',
        'name',
        'cadastre_number',
        'status'
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function plots(): HasMany
    {
        return $this->hasMany(Plot::class);
    }
}
