<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'regex:/^[a-zA-Z0-9\s]+$/'],
            // and so on
        ];
    }

    public function sanitize(){
        $input = $this->all();

        // input fields here eg,
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }
}
