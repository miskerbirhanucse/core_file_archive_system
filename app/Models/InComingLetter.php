<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InComingLetter extends Model
{
    use HasFactory;
     protected $fillable = [
        'subject', 'uploader_user_id', 'submitted_department_id',
        'action_taker_user_id','department_user_id','gm_id','secretary_added_department',
        'project_id', 'ref_no', 'file_path', 'letter_type','first_department_id','second_department_id',
        'file_name','remark','gm_description','head_description','team_description','gm_created_at','dept_created_at'
    ];
     public function uploader(){
        return $this->belongsTo(Users::class,'uploader_user_id');
    }

    public function departments(){
        return $this->belongsToMany(Department::class);
    }
    public function firstDepartment(){
         return $this->belongsTo(Department::class,'first_department_id');
    }
    public function secondDepartment(){
         return $this->belongsTo(Department::class,'second_department_id');
    }
    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function actionTaker(){
        return $this->belongsTo(Users::class,'action_taker_user_id');
    }

    public function departmentUser(){
        return $this->belongsTo(Users::class,'department_user');
    }
    public function otherDepartmentUser(){
        return $this->belongsTo(Users::class,'other_department_user');
    }
    public function otherActionTaker(){
        return $this->belongsTo(Users::class,'other_action_taker_user_id');
    }
    public function secretaryAddedDepartment(){
         return $this->belongsTo(Department::class,'secretary_added_department');
    }
}
