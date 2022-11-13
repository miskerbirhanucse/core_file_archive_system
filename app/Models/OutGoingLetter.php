<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutGoingLetter extends Model
{
    use HasFactory;
     protected $fillable = [
        'subject', 'uploader_user_id','department_id',
        'project_id', 'ref_no', 'file_path',
        'file_name','remark'
    ];
    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
     public function uploader(){
        return $this->belongsTo(Users::class,'uploader_user_id');
    }
}
