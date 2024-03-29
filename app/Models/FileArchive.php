<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'user_id', 'department_id', 'file_version',
        'project_id', 'ref_no', 'file_type', 'file_path', 'report_type', 'file_name'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
