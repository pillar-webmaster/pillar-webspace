<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatformRequest extends FormRequest
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
            'version' => ['required', 'string', 'max:255'],
            'requirements' => ['required', 'string', 'min:3', 'max:2000'],
        ];
    }

    public function sanitize(){
        $input = $this->all();

        // input fields here eg,
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['version'] = filter_var($input['version'], FILTER_SANITIZE_STRING);
        //$input['requirements'] = filter_var($input['requirements'], FILTER_SANITIZE_STRING);
        $input['requirements']  = clean($input['requirements']);

        $this->replace($input);
    }
}
