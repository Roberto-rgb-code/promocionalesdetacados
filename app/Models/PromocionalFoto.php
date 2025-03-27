<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromocionalFoto extends Model
{
    protected $fillable = ['promocional_id', 'foto_path'];

    public function promocional()
    {
        return $this->belongsTo(Promocional::class);
    }
}