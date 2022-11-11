<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class EventType extends Model
{
    public $timestamps = FALSE;
    protected $fillable = [
        'name',
        'color'
    ];

    // Get the entries for a specific event type.
    public function entries()
    {
        return $this->hasMany(EventType::class);
    }

    // Clear event_types cache upon modifying event
    protected static function boot()
    {
        parent::boot();

        static::saving(function() {
            Cache::forget('event_types');
        });
    }
}
