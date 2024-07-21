<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

class updateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Update Category.
        $a=Auth('sanctum')->user()->hasPermission("Update Category.");
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
            'name'=>'unique:categories',
            // 'id'=>'required' ,
            // 'name'=>'required',
            // 'superCategory_id'=>'required',
        ];
    }
}
