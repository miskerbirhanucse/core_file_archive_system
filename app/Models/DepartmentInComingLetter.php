<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
class DepartmentInComingLetter extends Pivot
{

    protected $fillable = ['department_id','in_coming_letter_id'];
    public $table='department_in_coming_letter';

}
