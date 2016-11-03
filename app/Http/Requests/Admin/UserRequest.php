<?php

namespace Mybankerbiz\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                if ($this->route('users') == auth()->user()->id) {
                    return false;
                }
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

    public function forbiddenResponse()
    {
        return redirect()->back()->withErrors([
            'error' => 'You are not able to delete yourself.'
        ]);
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
                    'name'      => 'required',
                    'email'     => 'required|email|unique:users',
                    'password'  => 'required|confirmed',
                    // 'role_list' => 'required|array',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    'name'      => 'required',
                    'email'     => 'required|email|unique:users,email,' . $this->route('user') . ',id',
                    // 'password'  => 'required_with:password_confirmation|confirmed',
                    // 'role_list' => 'required|array',
                ];

            default:
                return [];
        }
    }
}
