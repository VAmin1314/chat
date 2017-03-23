<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRelation extends Model
{
    $fillable = ['user_id', 'friend_id', 'group_id'];

    protected function user ()
    {
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }

    protected function friend ()
    {
        return $this->hasOne('App\Model\User', 'id', 'group_id');
    }






}
