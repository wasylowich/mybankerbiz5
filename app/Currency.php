<?php

namespace Mybankerbiz;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'precision',
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
     * Mutate the code attribute
     *
     * @param  string $code
     * @return void
     */
    public function setCodeAttribute($code)
    {
        $this->attributes['code'] = strtoupper(trim($code));
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
     * Get the code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the precision
     *
     * @return integer
     */
    public function getPrecision()
    {
        return $this->precision;
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
     * Set the code
     *
     * @param  string $code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Set the precision
     *
     * @param  integer $precision
     * @return void
     */
    public function setPrecision($precision)
    {
        $this->precision = (int) $precision;
    }
}
