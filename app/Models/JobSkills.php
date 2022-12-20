<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkills extends Model
{
    use HasFactory;

    protected $fillable = [
        'j_id',
        's_id',
    ];
}
