<?php

namespace Mybankerbiz;

class Bank extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'vatin',
        'website',
        'is_active',
        'bank_type_id',
        'interest_convention_id',
        'interest_term_id',
        'pension_interest_convention_id',
        'rebate_type_id',
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
     * Many-to-one relation with the Country model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Many-to-one relation with the BankType model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bankType()
    {
        return $this->belongsTo(BankType::class);
    }

    /**
     * Many-to-one relation with the InterestConvention model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interestConvention()
    {
        return $this->belongsTo(InterestConvention::class);
    }

    /**
     * Many-to-one relation with the InterestTerm model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interestTerm()
    {
        return $this->belongsTo(InterestTerm::class);
    }

    /**
     * Many-to-one relation with the InterestConvention model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pensionInterestConvention()
    {
        return $this->belongsTo(InterestConvention::class);
    }

    /**
     * Many-to-one relation with the RebateType model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rebateType()
    {
        return $this->belongsTo(RebateType::class);
    }

    /**
     * One-to-many relations with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
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
     * Get the status of the client
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
     * Mutate the website attribute
     *
     * @param  string $website
     * @return void
     */
    public function setWebsiteAttribute($website)
    {
        $this->attributes['website'] = trim($website);
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
     * @param  bool $isActive
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
     * Get the website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
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
     * Set the country_id
     *
     * @param  int|\App\Country $country
     * @return void
     */
    public function setCountry($country)
    {
        $this->country_id = is_a($country, Country::class)
            ? $country->getId()
            : $country;
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
     * Set the website
     *
     * @param  string $website
     * @return void
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Set the is_actve flag
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
