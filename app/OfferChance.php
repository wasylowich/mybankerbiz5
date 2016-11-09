<?php

namespace Mybankerbiz;

class OfferChance extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offer_chances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state',
        'bank_id',
        'bidder_id',
        'enquiry_id',
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
     * Updates the state of the OfferChance to 'accepted' in storage
     *
     * @return Mybankerbiz\OfferChance
     */
    public function accept()
    {
        $this->state = 'accepted';

        return $this;
    }

    /**
     * Updates the state of the OfferChance to 'rejected' in storage
     *
     * @return Mybankerbiz\OfferChance
     */
    public function decline()
    {
        $this->state = 'declined';

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
     * Set the state
     *
     * @param  string $state
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }
}
