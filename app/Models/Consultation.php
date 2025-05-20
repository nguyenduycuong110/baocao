<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'declaration',
        'accept_value',
        'reject_value',
        'entry_date',
        'note',
        'user_id',
        'publish',
        'close',
        'person_close_id',
    ];

    protected $with = ['users', 'person_close'];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function person_close(): BelongsTo{
        return $this->belongsTo(User::class, 'person_close_id', 'id');
    }


}
