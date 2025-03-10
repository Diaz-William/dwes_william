<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    public $timestamps = false;
    protected $fillable = [
        'emp_no', 'birth_date', 'first_name', 'last_name', 'gender', 'hire_date', 'baja'
    ];
    protected $casts = [
        'birth_date' => 'date',
        'hire_date' => 'date',
        'baja' => 'date'
    ];
    protected $primaryKey = 'emp_no';
    public $incrementing = false;
    protected $keyType = 'integer';
    public function departments()
    {
        return $this->hasMany(DeptEmp::class, 'emp_no', 'emp_no');
    }
}
