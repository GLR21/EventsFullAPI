<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'description',
        'dt_start',
        'dt_end',
        'dt_start_subscription',
        'dt_end_subscription'
    ];

    public $timestamps = false;

    public function getForeignKey(): string
    {
        return 'ref_event';
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
