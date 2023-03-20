<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storebranch extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'storebranch';
    protected $fillable = [
        'storename',
        'description',
        'location',
        'created_by'
    ];
}
