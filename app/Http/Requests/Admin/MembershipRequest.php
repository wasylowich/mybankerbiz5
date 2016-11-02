<?php

namespace Mybankerbiz\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
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
                    'name' => 'required|unique:memberships',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|unique:memberships,name,' . $this->route('membership') . ',id',
                ];

            default:
                return [];
        }
    }
}
