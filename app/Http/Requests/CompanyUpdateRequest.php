<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:20',
            'industry' => 'nullable|string|max:255',
            'employee_count' => 'nullable|integer',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'locations' => 'array',
            'locations.*.id' => 'nullable|integer|exists:company_locations,id',
            'locations.*.address' => 'required|string|max:255',
            'locations.*.google_maps_link' => 'nullable|url|max:255',
        ];
    }
}
