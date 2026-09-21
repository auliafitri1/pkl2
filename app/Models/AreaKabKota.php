<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaKabkota extends Model
{
    protected $table = 'areakabkota';
    protected $primaryKey = 'IdKabKota';
    public $timestamps = false;

    protected $fillable = [
        'IdKabKota',
        'KabupatenKota',
        'IdPropinsi',
    ];
}