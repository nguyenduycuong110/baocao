<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;

class Vehicle extends Model
{
    use HasQuery;

    protected $fillable = [
        'publish',
        'car_exit',
        'boats_exit',
        'car_entry',
        'boats_entry',
        'entry_date',
        'user_id'
    ];


    public function getRelations(): array {
        return [];
    }

}
