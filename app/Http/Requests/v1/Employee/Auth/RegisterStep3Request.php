<?php

namespace App\Http\Requests\v1\Employee\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep3Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nationality' => 'required|string|max:100',
            'project_id'  => 'required|exists:projects,id',
            'cache_key' => 'required'
        ];
    }
}
