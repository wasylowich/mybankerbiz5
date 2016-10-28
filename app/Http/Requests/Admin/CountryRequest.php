<?php

namespace Mybankerbiz\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch($this->method()) {
            case 'GET':
                break;

            case 'DELETE':
                break;

            case 'POST':
                break;

            case 'PUT':
            case 'PATCH':
                break;

            default:
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];

            case 'POST':
                return [
                    'name'                => 'required',
                    'local_short_form'    => 'required|unique:countries',
                    'abbreviation'        => 'unique:countries',
                    'iso_alpha_2'         => 'required|size:2|unique:countries',
                    'iso_alpha_3'         => 'required|size:3|unique:countries',
                    'telephone_code'      => 'required|digits_between:1,99999',
                    'tld'                 => 'required|unique:countries',
                    'default_currency_id' => 'required|exists:currencies,id,deleted_at,NULL',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    'name'                => 'required',
                    'local_short_form'    => 'required|unique:countries,local_short_form,' . $this->route('country') . ',id',
                    'abbreviation'        => 'unique:countries,abbreviation,' . $this->route('country') . ',id',
                    'iso_alpha_2'         => 'required|size:2|unique:countries,iso_alpha_2,' . $this->route('country') . ',id',
                    'iso_alpha_3'         => 'required|size:3|unique:countries,iso_alpha_3,' . $this->route('country') . ',id',
                    'telephone_code'      => 'required|digits_between:1,99999',
                    'tld'                 => 'required|unique:countries,tld,' . $this->route('country') . ',id',
                    'default_currency_id' => 'required|exists:currencies,id,deleted_at,NULL',
                ];

            default:
                return [];
        }
    }
}
