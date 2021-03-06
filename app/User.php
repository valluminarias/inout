<?php

namespace App;

use App\Enums\AttendanceType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function todayLatestAttendance()
    {
        return optional(
            $this->attendance()
                ->today()
                ->latest()
                ->first()
        );
    }

    public function hasCheckedIn()
    {
        return $this->todayLatestAttendance()->type == AttendanceType::CHECK_IN;
    }

    public function hasCheckedOut()
    {
        return $this->todayLatestAttendance()->type == AttendanceType::CHECK_OUT;
    }

    public function checkedToday()
    {
        return $this->attendance()->today()->whereIn('type', [AttendanceType::CHECK_IN, AttendanceType::CHECK_OUT])->count() >= 2;
    }

}
