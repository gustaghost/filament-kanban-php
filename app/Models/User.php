<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use App\Enums\UserStatus;

class User extends Authenticatable implements Sortable
{
    use HasFactory, Notifiable,SortableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'status' => UserStatus::class,
        ];
    }
    public static function ignoreTimestamps($should = true)
    {
        if ($should){
            static::$ignoreTimestampsOn = array_values(array_merge(static::$ignoreTimestampsOn, [static::class]));
        } else{
            static::$ignoreTimestampsOn = array_values(array_diff(static::$ignoreTimestampsOn, [static::class]));
        }
    }
}
