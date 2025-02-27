<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptEmp extends Model
{
    use HasFactory;
    protected $table = 'dept_emps';
    public $timestamps = false;
    protected $fillable = [
        'emp_no', 'dept_no', 'from_date', 'to_date'
    ];
    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];
    protected $primaryKey = null; // Laravel no soporta claves primarias compuestas nativamente
    public $incrementing = false;
    // Relación con Employees (Muchos a Uno)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }
    // Relación con Departments (Muchos a Uno)
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_no', 'dept_no');
    }
}
