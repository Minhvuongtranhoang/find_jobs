<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class JobUpdateRequest extends FormRequest
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
  public function rules()
  {
    return [
      'title' => 'required|string|max:255',
      'location_id' => 'required|exists:company_locations,id',
      'deadline' => 'required|date',
      'description' => 'required|string',
      'requirements' => 'required|string',
      'benefits' => 'required|string',
      'working_hours' => 'required|string',
      'salary' => 'required|string',
    ];
  }
}
