<?php

namespace App\Http\Requests;

use App\Enums\BloodType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateBloodRequest extends FormRequest
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
            //
            'division_id'   => 'required|int',
            'district_id'   => 'required|int',
            'upazila_id'    => 'required|int',
            'user_id'       => 'required|int',
            'hospital'      => 'required|string',
            'contact_name'  => 'required|string',
            'contact_phone' => 'required|string',
            'blood_group'   => ['required', new Enum(BloodType::class)],
            'required_bag'  => 'required|int',
            'donation_date' => 'required|string',
            'reference'     => 'required|string',
            'reason'        => 'required|string',
            'hemoglobin'    => 'required|string',
        ];
    }
}
