<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function task(){
        return $this->hasMany('App\Task');
    }
}
