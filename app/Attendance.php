<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    
    protected $fillable = [
        'user_id', 'type', 'log',
    ];

    protected $casts = [
        'log' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeToday($query)
    {
        return $query
            ->whereDate('log', now()->toDateString());
    }

}
