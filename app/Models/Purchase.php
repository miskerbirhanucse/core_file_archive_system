<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'specification', 'project_name',
        'approved_by_department', 'approved_by_store', 'authorized', 'quantity',
        'user_id', 'department_id', 'is_purchased', 'approve_id',
    ];
    public const APPROVED = 1;
    public const PENDING = 0;
    public const REJECTED = 2;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function approvedByDepartment()
    {
        return $this->belongsTo(User::class, 'approve_by_department_id');
    }
    public function approvedByStore()
    {
        return $this->belongsTo(User::class, 'approve_by_store_id');
    }
    public function authorizedBy()
    {
        return $this->belongsTo(User::class, 'authorized_id');
    }
}
