<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchandiseProduct extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'name',
        'value',
    ];

    public function merchandises(): BelongsTo
    {
        return $this->belongsTo(Merchandise::class, 'merchandise_id');
    }

}
