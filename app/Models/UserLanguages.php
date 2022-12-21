<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLanguages extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'lid',
        'proficiency',
    ];

    public function language()
    {
        return $this->hasOne('App\Models\Languages','id','lid');
    } 

}
