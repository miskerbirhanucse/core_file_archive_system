<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject', 'uploader_user_id', 'submitted_department_id',
        'action_taker_user_id','department_user_id','gm_id',
        'project_name', 'ref_no', 'file_path','secretary_added_department',
        'file_name','remark','description','head_description','gm_created_at','dept_created_at'
    ];
    public function uploader(){
        return $this->belongsTo(Users::class,'uploader_user_id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function actionTaker(){
        return $this->belongsTo(Users::class,'action_taker_user_id');
    }
    public function departmentUser(){
        return $this->belongsTo(Users::class,'department_user');
    }
    public function otherUser(){
        return $this->belongsTo(Users::class,'other_department_user ');
    }
    public function otherActionTaker(){
        return $this->belongsTo(Users::class,'other_action_taker_user_id ');
    }
}
