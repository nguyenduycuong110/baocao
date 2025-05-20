<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tax extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'vat_tax',
        'export_import_tax',
        'income_tax',
        'personal_income_tax',
        'other_revenue',
        'refunded_tax_declaration',
        'refunded_tax_amount',
        'current_debt',
        'overdue_debt',
        'tax_collection_declaration',
        'tax_amount',
        'business',
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
