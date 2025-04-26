<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;

class Passenger extends Model
{

    use HasQuery;

    protected $fillable = [
        'id',
        'departure',
        'entry',
        'entry_date',
        'user_id',
        'publish',
    ];


    public function getRelations(): array {
        return [];
    }

}
