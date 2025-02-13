<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Questions extends Model
{
    protected $fillable = [
        'name',
        'type',
        'choices',
        'dm_id',
    ];
    public function dm(): BelongsTo
    {
        return $this->belongsTo(Dm::class, 'dm_id');
    }
}
