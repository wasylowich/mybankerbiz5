<?php

namespace Mybankerbiz;

class UserProfile extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'is_active',
        'user_id',
        'membership_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types when accessed.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be cast to Carbon objects.
     *
     * @var array
     */
    protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | Section for: Custom Methods
    |--------------------------------------------------------------------------
    |
    | Define all custom methods for the model here
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Section for: Relation Methods
    |--------------------------------------------------------------------------
    |
    | Define all relation methods for the model here
    |
    */

    /**
     * Many-to-one relation with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Many-to-one relation with the Membership model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Section for: Scopes
    |--------------------------------------------------------------------------
    |
    | Define all model scopes here
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Section for: Accessors
    |--------------------------------------------------------------------------
    |
    | Define all model attribute accessors here
    |
    */

    /**
     * Get the status of the user_profile
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        if (!is_null($this->deleted_at)) {
            return 'deleted';
        }

        return $this->is_active ? 'active' : 'inactive';
    }

    /*
    |--------------------------------------------------------------------------
    | Section for: Mutators
    |--------------------------------------------------------------------------
    |
    | Define all model attribute mutators here
    |
    */

    /**
     * Mutate the avatar attribute
     *
     * @param  string $avatar
     * @return void
     */
    public function setAvatarAttribute($avatar)
    {
        $this->attributes['avatar'] = trim($avatar);
    }

    /**
     * Mutate the is_active attribute
     *
     * @param  bool $isActive
     * @return void
     */
    public function setIsActiveAttribute($isActive)
    {
        $this->attributes['is_active'] = (bool) $isActive;
    }

    /**
     * Mutate the status attribute
     *
     * @param  bool $status
     * @return void
     */
    public function setStatusAttribute($status)
    {
        $this->attributes['is_active'] = (bool) $status;
    }

    /*
    |--------------------------------------------------------------------------
    | Section for: Getters
    |--------------------------------------------------------------------------
    |
    | Define all public methods for getting model attribute values here
    |
    */

    /**
     * Get the avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the is_active flag
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return (bool) $this->is_active;
    }

    /*
    |--------------------------------------------------------------------------
    | Section for: Setters
    |--------------------------------------------------------------------------
    |
    | Define all public methods for setting model attribute values here
    |
    */

    /**
     * Set the user_id
     *
     * @param  int|\App\User $user
     * @return void
     */
    public function setUser($user)
    {
        $this->user_id = is_a($user, User::class)
            ? $user->getId()
            : $user;
    }

    /**
     * Set the membership_id
     *
     * @param  int|\App\User $membership
     * @return void
     */
    public function setMembership($membership)
    {
        $this->membership_id = is_a($membership, User::class)
            ? $membership->getId()
            : $membership;
    }

    /**
     * Set the avatar
     *
     * @param  string $avatar
     * @return void
     */
    public function setName($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * Set the is_active flag
     *
     * @param  bool|int $isActive
     * @return void
     */
    public function setIsActive($isActive)
    {
        $this->is_active = (bool) $isActive;
    }

    /**
     * Set the status
     *
     * @param  bool|int $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = (bool) $status;
    }
}
