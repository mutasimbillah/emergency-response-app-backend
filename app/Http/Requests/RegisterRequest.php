<?php

namespace App\Http\Requests;

use App\Enums\BloodType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'  => 'required|string|max:255',
            'blood_group'  => ['required', new Enum(BloodType::class)],
            'phone' => 'required|string|min:11|max:11',
        ];
    }
}
