<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    public $timestamps = false;
    protected $fillable = [
        'dept_no', 'dept_name'
    ];
    protected $primaryKey = 'dept_no';
    public $incrementing = false;
    protected $keyType = 'string';
    public function employees()
    {
        return $this->hasMany(DeptEmp::class, 'dept_no', 'dept_no');
    }
}
