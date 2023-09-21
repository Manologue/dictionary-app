<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Keyword extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'word',
        'active',
        'created_by',
        'updated_by',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('word')
            ->saveSlugsTo('slug');
    }

    protected function capitalizeWords($string)
    {
        // convert the string to lowercase
        $string = strtolower($string);
        // split the string by spaces
        $words = explode(' ', $string);
        // loop through each word
        foreach ($words as &$word) {
            // capitalize the first letter of each word
            $word = ucfirst($word);
        }
        // join the words back together by spaces
        $string = implode(' ', $words);
        // return the capitalized string
        return $string;
    }


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


    protected function word(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $this->capitalizeWords($value),
            // set: fn($value) => strtoupper($value),
        );
    }


    public function transwords(): HasMany
    {
        return $this->hasMany(Transword::class);
    }

}
