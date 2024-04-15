<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(Users::class, 'ref_user', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'ref_event', 'id');
    }

}
