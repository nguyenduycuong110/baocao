<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Unit extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'total_unit_personnel',
        'present_personnel',
        'leadership_duty',
        'absent_personnel',
        'training_absence',
        'leave_absence',
        'compensatory_leave',
        'entry_date',
        'user_id',
        'publish',
    ];


    public function getRelations(): array {
        return [];
    }

}
