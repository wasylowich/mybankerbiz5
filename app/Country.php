<?php

namespace Mybankerbiz;

class Country extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'local_short_form',
        'abbreviation',
        'iso_alpha_2',
        'iso_alpha_3',
        'telephone_code',
        'tld',
        'is_enabled',
        'default_currency_id',
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
        'is_enabled' => 'boolean',
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

    /**
     * Toggle the value of the is_enabled attribute
     *
     * @return \Mybankerbiz\Country
     */
    public function toggleEnabled()
    {
        $this->setIsEnabled(!$this->is_enabled);

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Section for: Relation Methods
    |--------------------------------------------------------------------------
    |
    | Define all relation methods for the model here
    |
    */

    /**
     * Many-to-one relation with the Currency model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function defaultCurrency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * One-to-many relations with the PostalCode model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postalCodes()
    {
        return $this->hasMany(PostalCode::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Section for: Scopes
    |--------------------------------------------------------------------------
    |
    | Define all model scopes here
    |
    */

    /**
    * Filters on enabled countries.
    *
    * @param  Illuminate\Database\Eloquent\Builder $builder
    * @return Illuminate\Database\Eloquent\Builder
    */
    public function scopeEnabled($builder)
    {
        return $builder->whereIsEnabled(true);
    }

    /**
    * Filters on disabled countries.
    *
    * @param  Illuminate\Database\Eloquent\Builder $builder
    * @return Illuminate\Database\Eloquent\Builder
    */
    public function scopeDisabled($builder)
    {
        return $builder->whereIsEnabled(false);
    }

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

        return $this->is_enabled ? 'enabled' : 'disabled';
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
     * Mutate the local_short_form attribute
     *
     * @param  string $localShortForm
     * @return void
     */
    public function setLocalShortFormAttribute($localShortForm)
    {
        $this->attributes['local_short_form'] = trim($localShortForm);
    }

    /**
     * Mutate the abbreviation attribute
     *
     * @param  string $abbreviation
     * @return void
     */
    public function setAbbreviationAttribute($abbreviation)
    {
        $this->attributes['abbreviation'] = trim($abbreviation);
    }

    /**
     * Mutate the iso_alpha_2 attribute
     *
     * @param  string $isoAlpha2
     * @return void
     */
    public function setIsoAlpha2Attribute($isoAlpha2)
    {
        $this->attributes['iso_alpha_2'] = trim($isoAlpha2);
    }

    /**
     * Mutate the iso_alpha_3 attribute
     *
     * @param  string $isoAlpha3
     * @return void
     */
    public function setIsoAlpha3Attribute($isoAlpha3)
    {
        $this->attributes['iso_alpha_3'] = trim($isoAlpha3);
    }

    /**
     * Mutate the telephone_code attribute
     *
     * @param  string $telephoneCode
     * @return void
     */
    public function setTelephoneCodeAttribute($telephoneCode)
    {
        $this->attributes['telephone_code'] = trim($telephoneCode);
    }

    /**
     * Mutate the tld attribute
     *
     * @param  string $tld
     * @return void
     */
    public function setTldAttribute($tld)
    {
        $this->attributes['tld'] = trim($tld);
    }

    /**
     * Mutate the is_enabled attribute
     *
     * @param  bool $isEnabled
     * @return void
     */
    public function setIsEnabledAttribute($isEnabled)
    {
        $this->attributes['is_enabled'] = (bool) $isEnabled;
    }

    /**
     * Mutate the status attribute
     *
     * @param  bool $status
     * @return void
     */
    public function setStatusAttribute($status)
    {
        $this->attributes['is_enabled'] = (bool) $status;
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
     * Get the local_short_form
     *
     * @return string
     */
    public function getLocalShortForm()
    {
        return $this->local_short_form;
    }

    /**
     * Get the abbreviation
     *
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Get the iso_alpha_2 code
     *
     * @return string
     */
    public function getIsoAlpha2()
    {
        return $this->iso_alpha_2;
    }

    /**
     * Get the iso_alpha_3 code
     *
     * @return string
     */
    public function getIsoAlpha3()
    {
        return $this->iso_alpha_3;
    }

    /**
     * Get the telephone_code
     *
     * @return string
     */
    public function getTelephoneCode()
    {
        return $this->telephone_code;
    }

    /**
     * Get the tld (top level domain)
     *
     * @return string
     */
    public function getTld()
    {
        return $this->tld;
    }

    /**
     * Get the is_enabled flag
     *
     * @return boolean
     */
    public function getIsEnabled()
    {
        return (bool) $this->is_enabled;
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
     * Set the default_currency_id
     *
     * @param  int|\App\Currency $defaultCurrency
     * @return void
     */
    public function setDefaultCurrency($defaultCurrency)
    {
        $this->default_currency_id = is_a($defaultCurrency, Currency::class)
            ? $defaultCurrency->getId()
            : $defaultCurrency;
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
     * Set the local_short_form
     *
     * @param  string $localShortForm
     * @return void
     */
    public function setLocalShortForm($localShortForm)
    {
        $this->local_short_form = $localShortForm;
    }

    /**
     * Set the abbreviation
     *
     * @param  string $abbreviation
     * @return void
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;
    }

    /**
     * Set the iso_alpha_2 code
     *
     * @param  string $isoAlpha2
     * @return void
     */
    public function setIsoAlpha2($isoAlpha2)
    {
        $this->iso_alpha_2 = $isoAlpha2;
    }

    /**
     * Set the iso_alpha_3 code
     *
     * @param  string $isoAlpha3
     * @return void
     */
    public function setIsoAlpha3($isoAlpha3)
    {
        $this->iso_alpha_3 = $isoAlpha3;
    }

    /**
     * Set the telephone_code
     *
     * @param  string $telephoneCode
     * @return void
     */
    public function setTelephoneCode($telephoneCode)
    {
        $this->telephone_code = $telephoneCode;
    }

    /**
     * Set the tld (top level domain)
     *
     * @param  string $tld
     * @return void
     */
    public function setTld($tld)
    {
        $this->tld = $tld;
    }

    /**
     * Set the is_enabled flag
     *
     * @param  bool|int $isEnabled
     * @return void
     */
    public function setIsEnabled($isEnabled)
    {
        $this->is_enabled = (bool) $isEnabled;
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
