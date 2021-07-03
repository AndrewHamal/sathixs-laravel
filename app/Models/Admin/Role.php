<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function admin()
    {
        return $this->hasMany('App\Models\Admin\Admin', 'role_id', 'id');
    }
}
