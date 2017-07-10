<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeRole extends Model
{
    protected $table = 'mode_role';
    public $timestamps = false;

    public function mode() {
        return $this->belongsTo('App\Models\Mode');
    }

    public function role() {
        return $this->belongsTo('App\Models\Role');
    }
}
