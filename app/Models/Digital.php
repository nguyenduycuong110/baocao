<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Digital extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'department_level',
        'branch_level',
        'entry_date',
        'user_id',
        'publish',
    ];


    public function getRelations(): array {
        return [];
    }

}
