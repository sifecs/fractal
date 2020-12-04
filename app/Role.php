<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
class Role extends EntrustRole
{
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }

    public function setPermissions($ids) {
        $this->permissions()->sync($ids);
    }
}
