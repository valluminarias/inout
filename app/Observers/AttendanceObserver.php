<?php

namespace App\Observers;

use App\Attendance;
use App\Enums\AttendanceType;
use App\Notifications\NotifyCheckedIn;
use App\Notifications\NotifyCheckedOut;
use App\Notifications\Slacker;
use Illuminate\Support\Facades\Notification;

class AttendanceObserver
{
    /**
     * Handle the attendance "created" event.
     *
     * @param  \App\Attendance  $attendance
     * @return void
     */
    public function created(Attendance $attendance)
    {
        if ($attendance->type == AttendanceType::CHECK_IN)
            Notification::send(new Slacker, new NotifyCheckedIn($attendance));
        if ($attendance->type == AttendanceType::CHECK_OUT)
            Notification::send(new Slacker, new NotifyCheckedOut($attendance));
    }

    /**
     * Handle the attendance "updated" event.
     *
     * @param  \App\Attendance  $attendance
     * @return void
     */
    public function updated(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the attendance "deleted" event.
     *
     * @param  \App\Attendance  $attendance
     * @return void
     */
    public function deleted(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the attendance "restored" event.
     *
     * @param  \App\Attendance  $attendance
     * @return void
     */
    public function restored(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the attendance "force deleted" event.
     *
     * @param  \App\Attendance  $attendance
     * @return void
     */
    public function forceDeleted(Attendance $attendance)
    {
        //
    }
}
