<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_process',
        'event_name',
        'short_desc',
        'long_desc',
        'image',
        'start_date',
        'end_date',
        'event_type_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event_type()
    {
        return $this->belongsTo(EventType::class);
    }

    // Clear events cache upon modifying event
    protected static function boot()
    {
        parent::boot();

        static::saving(function() {
            Cache::forget('events');
        });
    }
}
