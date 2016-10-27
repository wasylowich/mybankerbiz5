<?php

namespace Mybankerbiz\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
                    // 'country_id' => 'exists:countries,id,deleted_at,NULL',
                    'name'  => 'required|min:3',
                    'vatin' => 'digits:8',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    // 'country_id' => 'exists:countries,id,deleted_at,NULL',
                    'name'  => 'required|min:3',
                    'vatin' => 'digits:8',
                ];

            default:
                return [];
        }
    }
}
