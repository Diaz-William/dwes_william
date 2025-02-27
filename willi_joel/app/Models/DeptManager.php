<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptManager extends Model
{
    use HasFactory;
    protected $table = 'dept_managers';
    public $timestamps = false;
    protected $fillable = [
        'emp_no','dept_no', 'from_date','to_date'
    ];
    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];
    protected $primaryKey = null; // Laravel no soporta claves primarias compuestas nativamente
    public $incrementing = false;
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_no', 'dept_no');
    }
}
