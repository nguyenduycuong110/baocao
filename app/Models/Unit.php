<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'total_unit_personnel',
        'present_personnel',
        'leadership_duty',
        'absent_personnel',
        'training_absence',
        'leave_absence',
        'compensatory_leave',
        'entry_date',
        'user_id',
        'close',
        'person_close_id',
        'publish',
        'present_cbcc'
    ];


    protected $with = ['users', 'person_close'];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function person_close(): BelongsTo{
        return $this->belongsTo(User::class, 'person_close_id', 'id');
    }


}
