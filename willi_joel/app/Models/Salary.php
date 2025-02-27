<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries';
    public $timestamps = false;
    protected $fillable = [
        'emp_no', 'salary', 'from_date', 'to_date'
    ];
    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];
    protected $primaryKey = null; // Indica que no hay una clave primaria simple
    public $incrementing = false; // Laravel no maneja claves compuestas de forma automática
    protected $keyType = 'string';
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_no', 'emp_no');
    }
}
