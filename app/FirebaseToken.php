<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class FirebaseToken extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id', 'device_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
