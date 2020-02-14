<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'aer0220_users'; // Table Name

    public function userType()
    {
        return $this->belongsTo('App\Models\cat_user_types', 'user_type_id','user_type_id');
    }

}
