<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model

{
    // Propiedades y métodos en una sola declaración
    protected $fillable = [
        'name', 
        'scheduled_time', 
        'completed', 
        'comments', 
        'photo_path', 
        'area_id'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
} 

