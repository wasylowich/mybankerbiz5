<?php

namespace Mybankerbiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    public function __construct() {
        \Carbon\Carbon::setLocale('da');

        Parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function primaryKey()
    {
        return $this->getTable() . '.' . $this->getKeyName();
    }

    public function exists()
    {
        return $this->exists;
    }

    public function isDeleted()
    {
        return !is_null($this->deleted_at);
    }

    public function fillAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value)
        {
            $this->{$attribute} = $value;
        }

        return $this;
    }
}
