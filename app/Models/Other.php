<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    ];


    public function getRelations(): array {
        return [];
    }

}
