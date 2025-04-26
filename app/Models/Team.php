<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;

class Team extends Model
{

    use HasQuery;

    protected $fillable = [
        'name',
        'description',
        'publish',
        'manager_id'
    ];


    public function getRelations(): array {
        return ['user'];
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }
    

}
