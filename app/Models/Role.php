<?php

namespace App\Models;

use Laratrust\LaratrustRole;

class Role extends LaratrustRole
{
    public function role_user() {
        return $this->hasMany('App\Models\RoleUser');
    }

    public function mode_role() {
        return $this->hasOne('App\Models\ModeRole');
    }
}
