<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'internship_program';
    protected $fillable = [
        'position', 'supervisor', 'active_applicants', 'all_applicants', 'status'
    ];

    // Accessor for active applicants
    public function getActiveApplicantsAttribute()
    {
        return $this->applicant()->where('status', 'approved')->count();
    }

    // Accessor for all applicants
    public function getAllApplicantsAttribute()
    {
        return $this->applicant()->whereIn('status', ['approved', 'pending'])->count();
    }

    // Define the relationship with the Applicant model
    public function applicant()
    {
        return $this->hasMany(Applicant::class, 'position', 'position');
    }
}