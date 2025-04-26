<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    ];


    public function getRelations(): array {
        return [];
    }

}
