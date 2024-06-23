<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'date', 'time', 'location', 'description', 'image',
    ];
    //calling format() on a datetime not string
    protected $casts = [
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    
    public function userRating()
    {
        return $this->hasOne(Rating::class)->where('user_id', auth()->id());
    }
    public function reservations()
{
    return $this->hasMany(Reservation::class);
}

    
}
