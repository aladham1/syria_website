<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @method static filter()
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login_code',
        'phone',
        'is_admin',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'email_verified_at',
        'deleted_at',
        'created_at',
        'is_admin',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_users','user_id', 'role_id');
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsAdmin($query): mixed
    {
        return $query->where('is_admin', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotIsAdmin($query): mixed
    {
        return $query->where('is_admin', 0);
    }

    /**
     * @param $ability
     * @return bool
     */
    public function hasAbility($ability): bool
    {
        if ($this->id == 1){
            return true;
        }
        foreach ($this->roles as $role) {
            if (in_array($ability, $role->abilities)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $query
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function scopeFilter($query): mixed
    {
        return $query->when(\request()->get('query') != 'null' && !empty(\request()->get('query')), function ($q) {
            $q->where('name', 'LIKE', '%' . \request()->get('query') . '%')
                ->orWhere('email', 'LIKE', '%' . \request()->get('query') . '%')
                ->orWhere('phone', 'LIKE', '%' . \request()->get('query') . '%');
        })->when(\request()->get('type') == 1, function ($q) {
            $q->NotIsAdmin();
        })->when(!request()->get('type'), function ($q) {
            $q->isAdmin();
        });
    }

    public function facility()
    {
        return $this->hasOne(FacilityUser::class,'user_id');
    }

}
