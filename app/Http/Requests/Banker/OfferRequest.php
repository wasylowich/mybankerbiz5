<?php

namespace Mybankerbiz\Http\Requests\Banker;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
                    'interest'               => 'required',
                    // 'interest_convention_id' => 'required|exists:interest_conventions,id,deleted_at,NULL',
                    // 'interest_term_id'       => 'required|exists:interest_terms,id,deleted_at,NULL',
                ];

            case 'PUT':
            case 'PATCH':
                return [];

            default:
                return [];
        }
    }
}
