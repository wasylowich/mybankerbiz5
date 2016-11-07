<?php

namespace Mybankerbiz\Http\Requests\Customer;

use Mybankerbiz\Enumerations\EnumDepositType;
use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
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
                    // 'bidding_deadline'           => 'required|date',
                    'amount'                     => 'required|integer',
                    'fixation_period_start_date' => 'required_if:deposit_type_id,' . EnumDepositType::PERIOD . '|date',
                    'fixation_period_end_date'   => 'required_if:deposit_type_id,' . EnumDepositType::PERIOD . '|date',
                    // 'enquirer_id'                => 'required|exists:users,id,deleted_at,NULL',
                    'depositor_profile_id'       => 'required|exists:depositor_profiles,id,deleted_at,NULL',
                    'deposit_type_id'            => 'required|exists:deposit_types,id,deleted_at,NULL',
                    'currency_id'                => 'required|exists:currencies,id,deleted_at,NULL',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    // 'bidding_deadline'           => 'required|date',
                    'amount'                     => 'required|integer',
                    'fixation_period_start_date' => 'required_if:deposit_type_id,1|date',
                    'fixation_period_end_date'   => 'required_if:deposit_type_id,1|date',
                    // 'enquirer_id'                => 'required|exists:users,id,deleted_at,NULL',
                    'depositor_profile_id'       => 'required|exists:depositor_profiles,id,deleted_at,NULL',
                    'deposit_type_id'            => 'required|exists:deposit_types,id,deleted_at,NULL',
                    'currency_id'                => 'required|exists:currencies,id,deleted_at,NULL',
                ];

            default:
                return [];
        }
    }
}
