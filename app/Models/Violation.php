<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;

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
    ];


    public function getRelations(): array {
        return [];
    }

}
