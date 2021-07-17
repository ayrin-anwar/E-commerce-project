<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Color extends Model
{public $table = 'colors';
    use HasFactory;
    use SoftDeletes;
}
