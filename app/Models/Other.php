<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Other extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'admin_guidelines',
        'business_info',
        'issue_solving',
        'regulation_proposal',
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
