<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'max:255', 'regex:/^[a-zA-Z0-9_\-,;\(\)\s]+$/',
                Rule::unique('departments')->where(function($query){
                    return $query->where('status',1)
                        ->where('id', '<>', $this->id)
                    ;
                }),
            ],
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
