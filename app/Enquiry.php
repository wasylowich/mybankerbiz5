<?php

namespace Mybankerbiz;

class Enquiry extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'enquiries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'enquirer_id',
        'depositor_profile_id',
        'deposit_type_id',
        'currency_id',
        'bidding_deadline',
        'amount',
        'fixation_period_start_date',
        'fixation_period_end_date',
        'is_active',
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
    protected $dates = [
        'bidding_deadline',
        'fixation_period_start_date',
        'fixation_period_end_date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Section for: Custom Methods
    |--------------------------------------------------------------------------
    |
    | Define all custom methods for the model here
    |
    */

    /**
     * Marks the enquiry as archived
     *
     * @param  Mybankerbiz\User|string $archiver Indicates who/what performed the archiving
     * @return Mybankerbiz\Offer
     */
    public function archive($archiver)
    {
        if (is_a($archiver, User::class)) {
            // Archiver is a user, so get the role
            if (Auth::user()->hasAnyRole('sys-admin', 'admin')) {
                $archiver_role = 'admin';
            } elseif (Auth::user()->hasAnyRole('bidder')) {
                $archiver_role = 'bidder';
            } elseif (Auth::user()->hasAnyRole('depositor')) {
                $archiver_role = 'depositor';
            }

            $archiver_id = $archiver->id;
        } else {
            // Archiver is a system cron
            $archiver_role = $archiver;
            $archiver_id   = null;
        }

        // Set the pertinent archiving attributes on the enquiry object
        $this->archived_at   = \Carbon\Carbon::now();
        $this->archiver_role = $archiver_role;
        $this->archiver_id   = $archiver_id;

        // Once archived, an enquiry cannot be active.
        $this->is_active     = false;

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
     * Many-to-one relation with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enquirer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Many-to-one relation with the DepositorProfile model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function depositorProfile()
    {
        return $this->belongsTo(DepositorProfile::class);
    }

    /**
     * Many-to-one relation with the DepositType model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function depositType()
    {
        return $this->belongsTo(DepositType::class);
    }

    /**
     * Many-to-one relation with the Currency model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * One-to-many relation with the OfferChance model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offerChances()
    {
        return $this->hasMany(OfferChance::class);
    }

    /**
     * One-to-many relation with the Offer model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
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
     * Get the offersDeadline of the enquiry
     *
     * @return string
     */
    public function getOffersDeadlineAttribute()
    {
        if ($this->bidding_deadline->isPast()) {
            return $this->bidding_deadline->addDays(3)->diffForHumans();
        }

        return 'Auction ongoing';
    }

    /**
     * Get the status of the enquiry
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

    /**
     * Get the amount of the enquiry
     *
     * @param  integer $amount
     * @return integer|double
     */
    public function getAmountAttribute($amount)
    {
        if (!is_object($this->currency)) {
            return $amount;
        }

        return $amount / (10 ** $this->currency->precision);
    }

    /**
     * Get the fixation_period of the enquiry
     *
     * @return string
     */
    public function getFixationPeriodAttribute()
    {
        if ($this->depositType->name === 'pension') {
            return;
        }

        $start = $this->fixation_period_start_date;
        $end   = $this->fixation_period_end_date;

        return $start->diffInDays($end);
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
     * Mutate the bidding_deadline attribute
     *
     * @param  string $biddingDeadline
     * @return void
     */
    public function setBiddingDeadlineAttribute($biddingDeadline)
    {
        $this->attributes['bidding_deadline'] = $biddingDeadline;
    }

    /**
     * Mutate the amount attribute
     *
     * @param  string $amount
     * @return void
     */
    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = (int) $amount;

        // if (!is_object($this->currency)) {
        //     $this->attributes['amount'] = (int) $amount;
        // } else {
        //     $this->attributes['amount'] = (int) $amount * (10 ** $this->currency->precision);
        // }
    }

    /**
     * Mutate the fixation_period_start_date attribute
     *
     * @param  \Carbon\Carbon $fixationPeriodStartDate
     * @return void
     */
    public function setFixationPeriodStartDateAttribute($fixationPeriodStartDate)
    {
        $this->attributes['fixation_period_start_date'] = $fixationPeriodStartDate;
    }

    /**
     * Mutate the fixation_period_end_date attribute
     *
     * @param  \Carbon\Carbon $fixationPeriodEndDate
     * @return void
     */
    public function setFixationPeriodEndDateAttribute($fixationPeriodEndDate)
    {
        $this->attributes['fixation_period_end_date'] = $fixationPeriodEndDate;
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
     * Get the bidding_deadline
     *
     * @return string
     */
    public function getBidding_deadline()
    {
        return $this->bidding_deadline;
    }

    /**
     * Get the amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the fixation_period_start_date
     *
     * @return string
     */
    public function getFixationPeriodStartDate()
    {
        return $this->fixation_period_start_date;
    }

    /**
     * Get the fixation_period_end_date
     *
     * @return string
     */
    public function getFixationPeriodEndDate()
    {
        return $this->fixation_period_end_date;
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
     * Set the enquirer_id
     *
     * @param  int|\App\User $enquirer
     * @return void
     */
    public function setEnquirer($enquirer)
    {
        $this->enquirer_id = is_a($enquirer, User::class)
            ? $enquirer->getId()
            : $enquirer;
    }

    /**
     * Set the deposit_type_id
     *
     * @param  int|\App\Customer $depositType
     * @return void
     */
    public function setDepositType($depositType)
    {
        $this->deposit_type_id = is_a($depositType, DepositType::class)
            ? $depositType->getId()
            : $depositType;
    }

    /**
     * Set the bidding_deadline
     *
     * @param  string $biddingDeadline
     * @return void
     */
    public function setBiddingDeadline($biddingDeadline)
    {
        $this->bidding_deadline = $biddingDeadline;
    }

    /**
     * Set the amount
     *
     * @param  null|string $amount
     * @return void
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Set the fixation_period_start_date
     *
     * @param  \Carbon\Carbon $fixationPeriodStartDate
     * @return void
     */
    public function setFixationPeriodStartDate($fixationPeriodStartDate)
    {
        $this->fixation_period_start_date = $fixationPeriodStartDate;
    }

    /**
     * Set the fixation_period_end_date
     *
     * @param  \Carbon\Carbon $fixationPeriodEndDate
     * @return void
     */
    public function setFixationPeriodEndDate($fixationPeriodEndDate)
    {
        $this->fixation_period_end_date = $fixationPeriodEndDate;
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
