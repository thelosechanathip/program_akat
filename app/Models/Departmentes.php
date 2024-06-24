<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departmentes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function employee_system_requests() {
        return $this->hasMany(Employee_system_requests::class, 'prefix_id');
    }
}
