<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    //telling the laravel the name of the project
    protected $table = 'project_user';
    protected $fillable = [
    	'project_id',
    	'user_id'
    ];
}
