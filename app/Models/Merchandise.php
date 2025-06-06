<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merchandise extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'entry_date',
        'user_id',
        'publish',
        'close',
        'person_close_id',
    ];

    protected $table = 'merchandises';

    protected $with = ['users', 'person_close'];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function merchandise_products(): HasMany
    {
        return $this->hasMany(MerchandiseProduct::class, 'merchandise_id');
    }

    public function person_close(): BelongsTo{
        return $this->belongsTo(User::class, 'person_close_id', 'id');
    }

    public function getRelations(): array
    {
        return ['merchandise_products'];
    }


}
