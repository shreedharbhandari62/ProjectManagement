<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //column of project table
    protected $fillable = [
    	'name',
    	'description',
    	'company_id',
    	'user_id',
    	'days'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function company(){
        return $this->belongsTo('App\Company');
    }
    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
    
}
