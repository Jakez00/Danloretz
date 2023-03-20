<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logs extends Model
{
  use SoftDeletes;
  protected $table = 'logs';
  protected $fillable = [
    'user_id',
    'description',
    'store',
    // 'ip_address',
    // 'table_name',
    // 'row_id'
];
}

