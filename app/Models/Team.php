<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Team extends Model
{

    use HasFactory, Notifiable, HasQuery;

    protected $fillable = [
        'name',
        'description',
        'publish',
        'manager_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    public function team_vices(): BelongsToMany{
        return $this->belongsToMany(User::class, 'team_vice', 'team_id', 'user_id');
    }

    public function getRelations(): array {
        return ['user','team_vices'];
    }

    

}
