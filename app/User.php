<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends \TCG\Voyager\Models\User
{
    use Notifiable, SoftDeletes, \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'google_id', 'avatar',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    public function fullName()
    {
        return ucfirst($this->name);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime',];


    public function company_profiles()
    {
        return $this->belongsToMany('App\CompanyProfile','user_companies','user_id','company_id');
    }

    public function user_companies()
    {
        return $this->hasMany('App\UserCompany','user_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city');
    }

    public function buysells()
    {
        return $this->hasMany(\App\BuySell::class);
    }

    public function scopeSubAdmins($query)
    {
        return $query->where('role_id', 3);
    }

    public function scopeUsers($query)
    {
        return $query->where('role_id', 2);
    }


    public function my_office()
    {
        return $this->hasOne(UserCompany::class, 'user_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message', 'sender_id', 'id');
    }

    public function types()
    {
        return $this->belongsToMany(\App\UType::class, 'user_types', 'user_id', 'u_type_id');
    }

    public function getCreatedAtAttribute($value)
    {
        if ($value != null) {
            return \Carbon\Carbon::parse($value)->format('d-M-Y h:i A');
        } else {
            return '';
        }
    }
}
