<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_system_requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'birthdate',
        'joindate',
        'prefix_id',
        'thai_first_name',
        'thai_last_name',
        'eng_first_name',
        'eng_last_name',
        'cid',
        'department_id',
        'role_id',
        'medical_license_no',
        'medical_license_start',
        'medical_license_expire',
        'emp_username',
        'emp_password'
    ];

    public function prefixes() {
        return $this->belongsTo(Prefixes::class, 'prefix_id');
    }

    public function departmentes() {
        return $this->belongsTo(Departmentes::class, 'department_id');
    }

    public function roles() {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
