<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
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

    /**
     * Todo relation
     *
     */
    function todos()
    {
        return $this->hasMany('App\Todo');
    }

        /**
     * Get user todos with paginator
     * 
     * @param \App\User
     * @return 
     */
    public function getTodoList(?String $date, ?int $perPage = 5)
    {
        $this
            ->todos()
            ->whereDate('created_at', $date)
            ->paginate($perPage);
    }
}
