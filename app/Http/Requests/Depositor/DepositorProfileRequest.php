<?php

namespace Mybankerbiz\Http\Requests\Depositor;

use Illuminate\Foundation\Http\FormRequest;

class DepositorProfileRequest extends FormRequest
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
                    'name'              => 'required|min:3',
                    'vatin'             => 'digits:8',
                    'pin'               => 'required',
                    // 'user_id'           => 'required|exists:users,id,deleted_at,NULL',
                    'depositor_type_id' => 'required|exists:depositor_types,id,deleted_at,NULL',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    'name'              => 'required|min:3',
                    'vatin'             => 'digits:8',
                    'pin'               => 'required',
                    // 'user_id'           => 'required|exists:users,id,deleted_at,NULL',
                    'depositor_type_id' => 'required|exists:depositor_types,id,deleted_at,NULL',
                ];

            default:
                return [];
        }
    }
}
