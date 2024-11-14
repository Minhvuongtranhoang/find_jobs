<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'employee_count' => 'nullable|integer',
            'locations' => 'nullable|array',
            'locations.*.address' => 'required_with:locations|string|max:255',
            'locations.*.city' => 'required_with:locations|string|max:255',
            'locations.*.state' => 'required_with:locations|string|max:255',
            'locations.*.zip' => 'required_with:locations|string|max:10',
        ];
    }
}
?>
