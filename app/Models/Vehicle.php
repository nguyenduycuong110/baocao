<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasQuery;

    protected $fillable = [
        'publish',
        'car_exit',
        'boats_exit',
        'car_entry',
        'boats_entry',
        'entry_date',
        'close',
        'person_close_id',
        'user_id'
    ];


    protected $with = ['users', 'person_close'];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function person_close(): BelongsTo{
        return $this->belongsTo(User::class, 'person_close_id', 'id');
    }

}
