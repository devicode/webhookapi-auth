<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trello extends Model
{
    public function user(){
        return $this->belongsTo('User');
    }

}
