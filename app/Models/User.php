<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasQuery;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasQuery;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'account',
        'email',
        'name',
        'cid',
        'user_catalogue_id',
        'hide_date',
        'password',
        'birthday',
        'image',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'publish',
        'phone',
        'team_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [
        'user_catalogues',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user_catalogues(): BelongsTo{
        return $this->belongsTo(UserCatalogue::class, 'user_catalogue_id', 'id');
    }

    public function teams(): BelongsTo{
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function getRelations(): array {
        return ['user_catalogues','teams'];
    }

}
