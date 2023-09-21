<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Transword extends Model
{

    protected $fillable = [
        'word',
        'class',
        'vocal',
        'etymology',
        'sample',
        'active',
        'keyword_id',
        'created_by',
        'updated_by',
    ];
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('word')
            ->saveSlugsTo('slug');
    }

    public function keyword(): BelongsTo
    {
        return $this->belongsTo(Keyword::class);
    }

    public function idioms(): HasMany
    {
        return $this->hasMany(Idioms::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
