<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
          ];
          
          if ($this->isMethod('POST')) {
            $rules['password'] = 'required|min:6|confirmed';
        }

         if ($this->isMethod('PUT')) {
            $userId = $this->route('user');  
            $rules['email'] = 'required|email|unique:users,email,' . $userId->id;

            if ($this->filled('password')) {
                $rules['password'] = 'required|min:6|confirmed';
            }
          }


          

 
        return $rules;
    }
}
