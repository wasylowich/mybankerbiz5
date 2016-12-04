<?php

namespace Mybankerbiz;

class Offer extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state',
        'deadline',
        'fixation_period_months',
        'interest',
        'amount',
        'bank_id',
        'bidder_id',
        'enquiry_id',
        'currency_id',
        'offer_chance_id',
        'interest_convention_id',
        'interest_term_id',
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

    /**
     * Marks the offer as archived
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

        // Set the pertinent archiving attributes on the offer object
        $this->archived_at   = \Carbon\Carbon::now();
        $this->archiver_role = $archiver_role;
        $this->archiver_id   = $archiver_id;

        // Once archived, an offer cannot be active.
        $this->state         = 'archived';

        return $this;
    }

    /**
     * Updates the state of the Offer to 'accepted' in storage
     *
     * @return Mybankerbiz\Offer
     */
    public function accept()
    {
        $this->state = 'accepted';

        return $this;
    }

    /**
     * Updates the state of the Offer to 'cancelled' in storage
     *
     * @return Mybankerbiz\Offer
     */
    public function cancel()
    {
        $this->state = 'cancelled';

        return $this;
    }

    /**
     * Updates the state of the Offer to 'rejected' in storage
     *
     * @return Mybankerbiz\Offer
     */
    public function reject()
    {
        $this->state = 'rejected';

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
     * Many-to-one relation with the Bank model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * Many-to-one relation with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bidder()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Many-to-one relation with the Enquiry model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
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
     * Many-to-one relation with the OfferChance model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offerChance()
    {
        return $this->belongsTo(OfferChance::class);
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

    /*
    |--------------------------------------------------------------------------
    | Section for: Mutators
    |--------------------------------------------------------------------------
    |
    | Define all model attribute mutators here
    |
    */

    /**
     * Mutate the state attribute
     *
     * @param  string $state
     * @return void
     */
    public function setStateAttribute($state)
    {
        $this->attributes['state'] = trim($state);
    }

    /**
     * Mutate the interest attribute
     *
     * @param  string $interest
     * @return void
     */
    public function setInterestAttribute($interest)
    {
        $this->attributes['interest'] = (float) $interest;
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
     * Get the state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the interest
     *
     * @return float
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * Get the amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
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
     * Set the bidder_id
     *
     * @param  int|\App\User $bank
     * @return void
     */
    public function setBidder($bidder)
    {
        $this->bidder_id = is_a($bidder, User::class)
            ? $bidder->getId()
            : $bidder;
    }

    /**
     * Set the enquiry_id
     *
     * @param  int|\App\Bank $enquiry
     * @return void
     */
    public function setEnquiry($enquiry)
    {
        $this->enquiry_id = is_a($enquiry, Bank::class)
            ? $enquiry->getId()
            : $enquiry;
    }

    /**
     * Set the currency_id
     *
     * @param  int|\App\Currency $currency
     * @return void
     */
    public function setCurrency($currency)
    {
        $this->currency_id = is_a($currency, Currency::class)
            ? $currency->getId()
            : $currency;
    }

    /**
     * Set the offer_chance_id
     *
     * @param  int|\App\Bank $offerChance
     * @return void
     */
    public function setOfferChance($offerChance)
    {
        $this->offer_chance_id = is_a($offerChance, Bank::class)
            ? $offerChance->getId()
            : $offerChance;
    }

    /**
     * Set the state
     *
     * @param  string $state
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Set the interest
     *
     * @param  float $interest
     * @return void
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;
    }

    /**
     * Set the amount
     *
     * @param  float $amount
     * @return void
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
}
