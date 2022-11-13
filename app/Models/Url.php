<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Url extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function url_calls(): HasMany
    {
        return $this->hasMany(UrlCall::class);
    }

    protected function shorturl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => route('redirect',$this->short_url_string),
        );
    }
}