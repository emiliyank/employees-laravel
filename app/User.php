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
        'name', 'lastname', 'email', 'password', 'avatar'
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

    public function managers()
    {
        return $this->belongsToMany(User::class, 'manager_user', 'user_id', 'manager_id')->withTimestamps();
    }

    public function subservants()
    {
        return $this->belongsToMany(User::class, 'manager_user', 'manager_id', 'user_id');
    }

    public function assignManagers()
    {
        $managersIds = $this->get2ManagerIdsWithLeastSubservants();

        $this->managers()->attach($managersIds);

        return $managersIds;
    }

    private function get2ManagerIdsWithLeastSubservants()
    {
        return $this->where('role', 'manager')->withCount('subservants')->orderBy('subservants_count', 'asc')->limit(2)->pluck('id');
    }

    public static function getManagersSubservantsEmails($managersIds)
    {
        return static::whereHas('managers', function($query) use ($managersIds){
            $query->whereIn('manager_id', $managersIds);
        })->pluck('email');
    }
}
