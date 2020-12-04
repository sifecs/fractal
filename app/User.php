<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use EntrustUserTrait; // add this trait to your user model
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function purchase(){
        return $this->belongsToMany('App\Category','user_purchases');
    }

    public function country(){
        return $this->belongsTo('App\Country');
    }

    public function companies() {
        return $this->hasMany('App\Company');
    }

    public function setRoles($ids) {
        $this->roles()->sync($ids);
    }

    public function setPurchase($ids) {
        $this->purchase()->sync($ids);
    }
}
