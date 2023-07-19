<?php

namespace App\Models;

use App\Models\Pengurus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function pengurus(): HasMany
    {
        return $this->hasMany(Pengurus::class);
    }
}
