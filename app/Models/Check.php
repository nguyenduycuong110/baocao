<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Check extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'department_level',
        'branch_level',
        'entry_date',
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
