<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Gallery extends Model
{public $table = 'galleries';
    use HasFactory;
    use SoftDeletes;
}
