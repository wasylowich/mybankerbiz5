<?php

namespace Mybankerbiz;

class BankProfile extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bank_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logo',
        'annual_report',
        'bio',
        'bank_id',
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
    protected $casts = [];

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
     * Many-to-one relation with the Bank model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
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
     * Get the status of the bank_profile
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
     * Mutate the logo attribute
     *
     * @param  string $logo
     * @return void
     */
    public function setAvatarAttribute($logo)
    {
        $this->attributes['logo'] = trim($logo);
    }

    /**
     * Mutate the annual_report attribute
     *
     * @param  string $annualReport
     * @return void
     */
    public function setAnnualReportAttribute($annualReport)
    {
        $this->attributes['annual_report'] = trim($annualReport);
    }

    /**
     * Mutate the bio attribute
     *
     * @param  string $bio
     * @return void
     */
    public function setBioAttribute($bio)
    {
        $this->attributes['bio'] = trim($bio);
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
     * Get the logo
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->logo;
    }

    /**
     * Get the annual_report
     *
     * @return string
     */
    public function getAnnualReport()
    {
        return $this->annual_report;
    }

    /**
     * Get the bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
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
     * Set the bank_id
     *
     * @param  int|\App\Bank $bank
     * @return void
     */
    public function setBank($bank)
    {
        $this->bank_id = is_a($bank, Bank::class)
            ? $bank->getId()
            : $bank;
    }

    /**
     * Set the logo
     *
     * @param  string $logo
     * @return void
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Set the annual_report
     *
     * @param  string $annualReport
     * @return void
     */
    public function setAnnualReport($annualReport)
    {
        $this->annual_report = $annualReport;
    }

    /**
     * Set the bio
     *
     * @param  string $bio
     * @return void
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }
}
