<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'internship_program';
    protected $fillable = [
        'position', 'supervisor', 'active_applicants', 'all_applicants', 'status'
    ];
}