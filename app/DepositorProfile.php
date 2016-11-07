<?php

namespace Mybankerbiz;

class DepositorProfile extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'depositor_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'vatin',
        'pin',
        'is_primary',
        'is_active',
        'user_id',
        'depositor_type_id',
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
        'is_primary' => 'boolean',
        'is_active'  => 'boolean',
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
     * Many-to-one relation with the DepositorType model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function depositorType()
    {
        return $this->belongsTo(DepositorType::class);
    }

    /**
     * One-to-many relations with the Enquiry model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
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
     * Get the primary indicator of the depositor_profile
     *
     * @return string
     */
    public function getPrimaryAttribute()
    {
        return $this->is_primary ? 'primary' : '';
    }

    /**
     * Get the status of the depositor_profile
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
     * Mutate the name attribute
     *
     * @param  string $name
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = trim($name);
    }

    /**
     * Mutate the vatin attribute
     *
     * @param  string $vatin
     * @return void
     */
    public function setVatinAttribute($vatin)
    {
        $this->attributes['vatin'] = trim($vatin);
    }

    /**
     * Mutate the pin attribute
     *
     * @param  string $pin
     * @return void
     */
    public function setPinAttribute($pin)
    {
        $this->attributes['pin'] = trim($pin);
    }

    /**
     * Mutate the is_primary attribute
     *
     * @param  bool $isPrimary
     * @return void
     */
    public function setIsPrimaryAttribute($isPrimary)
    {
        $this->attributes['is_primary'] = (bool) $isPrimary;
    }

    /**
     * Mutate the primary attribute
     *
     * @param  bool $primary
     * @return void
     */
    public function setPrimaryAttribute($primary)
    {
        $this->attributes['is_primary'] = (bool) $primary;
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
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the VATIN
     *
     * @return string
     */
    public function getVatin()
    {
        return $this->vatin;
    }

    /**
     * Get the PIN
     *
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * Get the is_primary flag
     *
     * @return boolean
     */
    public function getIsPrimary()
    {
        return (bool) $this->is_primary;
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
     * Set the depositor_type_id
     *
     * @param  int|\App\Customer $depositorType
     * @return void
     */
    public function setDepositorType($depositorType)
    {
        $this->depositor_type_id = is_a($depositorType, DepositorType::class)
            ? $depositorType->getId()
            : $depositorType;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set the VATIN
     *
     * @param  null|string $vatin
     * @return void
     */
    public function setVatin($vatin)
    {
        $this->vatin = !is_null($vatin) ? trim($vatin) : null;
    }

    /**
     * Set the PIN
     *
     * @param  null|string $pin
     * @return void
     */
    public function setPin($pin)
    {
        $this->pin = !is_null($pin) ? trim($pin) : null;
    }

    /**
     * Set the is_primary flag
     *
     * @param  bool|int $isPrimary
     * @return void
     */
    public function setIsPrimary($isPrimary)
    {
        $this->is_primary = (bool) $isPrimary;
    }

    /**
     * Set the primary
     *
     * @param  bool|int $primary
     * @return void
     */
    public function setPrimary($primary)
    {
        $this->primary = (bool) $primary;
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
