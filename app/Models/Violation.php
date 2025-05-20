<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Violation extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'smuggling_cases',
        'smuggling_value',
        'drug_cases',
        'drug_pills',
        'ip_cases',
        'ip_value',
        'admin_cases',
        'admin_value',
        'other_cases',
        'other_value',
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
