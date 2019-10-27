<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    public function redirects(){
        return $this->hasMany('App\Redirect');
    }
}
