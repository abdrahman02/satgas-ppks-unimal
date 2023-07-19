<?php

namespace App\Models;

use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengurus extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }
}
