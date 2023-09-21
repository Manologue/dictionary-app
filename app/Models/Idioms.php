<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Idioms extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'transword_id',
        'created_by',
        'updated_by',
    ];
    public function transword(): BelongsTo
    {
        return $this->belongsTo(Transword::class);
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
