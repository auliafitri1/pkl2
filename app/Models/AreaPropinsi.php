<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaPropinsi extends Model
{
    protected $table = 'areapropinsi';
    protected $primaryKey = 'IdPropinsi';
    public $timestamps = false;

    protected $fillable = [
        'IdPropinsi',
        'Propinsi',
        'IdNegara',
        'SortOrder'
    ];
}