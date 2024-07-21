<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $table = 'applicant';
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'position', 'status'
    ];
}
