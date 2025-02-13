<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dm extends Model
{
    protected $fillable = [
        'title',
        'description',
        'expire_at',
        'professor_id'
    ];
    public function professor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'professor_id');
    }
    public function questions(): HasMany
    {
        return $this->hasMany(Questions::class, 'dm_id');
    }
}
