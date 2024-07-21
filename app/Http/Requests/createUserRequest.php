<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

class createUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Create User.
        $a=Auth('sanctum')->user()->hasPermission("Create User.");
        return   $a=='allow' ? true : false;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:100',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:100',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'postal_code'=>'required|regex:/^(?:(\d{5})(?:[ \-](\d{4}))?)$/i',
            'country' => 'required|regex:/^[\pL\s\-]+$/u|max:45',
            'city' => 'required|regex:/^[\pL\s\-]+$/u|max:45',
        ];
    }
}
