<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'link',
        'is_read'
    ];

    /**
     * Get the notification's link, ensuring it is a full URL.
     *
     * @param  string  $value
     * @return string
     */
    public function getLinkAttribute($value)
    {
        // Check if the link is already an absolute URL
        if (parse_url($value, PHP_URL_SCHEME) !== null) {
            return $value;
        }

        // Otherwise, prepend the base URL
        return url('/') . ltrim($value, '/');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 