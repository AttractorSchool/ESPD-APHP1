<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'phone',
        'country',
        'city',
        'avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
           'id'         => Where::class,
           'name'       => Like::class,
           'email'      => Like::class,
           'updated_at' => WhereDateStartEnd::class,
           'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];
    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    /**
     * @return HasMany
     */

    public function subscription(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * @return HasMany
     */
    public function custom_notifications(): HasMany
    {
        return $this->hasMany(CustomNotification::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function cityName(): string
    {
        return $this->city()->get('name');

    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    /**
     * @return BelongsToMany
     */
    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class, 'user_interests');
    }

    /**
     * @return HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * @return mixed|null
     */
    public function mentorRole(): mixed
    {
        return $this->roles()->where('name', 'mentor')->first();
    }

    /**
     * @return HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }


    /**
     * @return mixed
     */
    public function averageRating(): mixed
    {
        return $this->ratings()->avg('rating');
    }

    /**
     * @return mixed
     */
    public function sevenDayAnalytic()
    {
        return User::whereNotNull('last_login_at')
            ->whereBetween('last_login_at', [Carbon::now()->copy()->subDays(7), Carbon::now()])
            ->count();
    }

    /**
     * @return mixed
     */
    public function monthAnalytic()
    {
        return User::whereNotNull('last_login_at')
            ->wheremonth('last_login_at', '=', Carbon::now()->month)
            ->whereYear('last_login_at', '=', Carbon::now()->year)
            ->count();
    }

    /**
     * @return mixed
     */
    public function yearAnalytic()
    {
        return User::whereNotNull('last_login_at')
            ->whereYear('last_login_at', '=', Carbon::now()->year)
            ->count();
    }
}
