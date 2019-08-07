<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $this->sanitize();

        return [
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'department_id' => ['required', 'integer'],
            'designation_id' => ['required', 'integer'],
        ];
    }

    public function sanitize(){
        $input = $this->all();

        // input fields here eg,
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['contact'] = filter_var($input['contact'], FILTER_SANITIZE_STRING);
        $input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $input['department_id'] = filter_var($input['department_id'], FILTER_SANITIZE_NUMBER_INT);
        $input['designation_id'] = filter_var($input['designation_id'], FILTER_SANITIZE_NUMBER_INT);

        $this->replace($input);
    }

    public function messages(){
        return [
            'department_id.required' => 'You should select a department',
            'designation_id.required' => 'You should select a designation',
        ];
    }
}
