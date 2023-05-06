<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemtype extends Model
{
    use HasFactory;

    protected $fillable = [
        'itemtypename',
        'description',
        'store',
        'created_by'
    ];
}
