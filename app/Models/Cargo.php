<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cargo extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'green_channel',
        'yellow_channel',
        'red_channel',
        'void_declaration',
        'green_channel_import',
        'yellow_channel_import',
        'red_channel_import',
        'void_declaration_import',
        'temp_import',
        'reexport',
        'overdue_not_reexported',
        'export_turnover',
        'import_turnover',
        'taxable_export_turnover',
        'taxable_import_turnover',
        'outgoing_transit',
        'incoming_transit',
        'outgoing_transit_turnover',
        'incoming_transit_turnover',
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
