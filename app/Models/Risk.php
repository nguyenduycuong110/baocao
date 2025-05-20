<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Risk extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'flow_decl',
        'stop_via_supervision',
        'violated_decl',
        'collect_bus_info',
        'prop_disb_setup',
        'act_disb_setup',
        'item_profile_set',
        'bus_profile_set',
        'entry_date',
        'user_id',
        'publish',
    ];

    protected $with = ['users'];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
