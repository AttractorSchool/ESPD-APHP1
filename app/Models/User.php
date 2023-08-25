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
        'lastname',
        'avatar',
        'email',
        'phone',
        'country',
        'city',
        'password',
        'permissions',
        'last_booking_date'
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
        return $this->hasMany(Review::class, 'user_id');
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


    /**
     * @return HasMany
     */
    public function courses_author():HasMany //только автор(ментор) может пользоваться
    {
        return $this->hasMany(Course::class, 'author_id');
    }

    /**
     * @return BelongsToMany
     */
    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class, 'user_subscriptions', 'user_id', 'subscription_id')
            ->withPivot('start_date', 'end_date')
            ->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function subscription(): HasMany
    {
        return $this->hasMany(UserSubscription::class, 'user_id');
    }

    /**
     * @return bool
     */
    public function hasActiveSubscription(): bool
    {
        return $this->subscriptions()
            ->where('end_date', '>=', now())
            ->exists();
    }

    /**
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'user_courses');
    }

    /**
     * @return HasMany
     */
    public function events():HasMany
    {
        return $this->hasMany(Event::class, 'author_id');
    }
}
