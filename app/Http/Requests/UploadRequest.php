<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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

        // possible to change to sometimes from required all file input fields?
        $rules = [
            'description' => ["nullable", "string", "max:1000"],
            'webspace_id' => ["required"],
            "path" => ['required','mimes:pdf','max:2000'],
        ];
        return $rules;
    }

    public function sanitize(){
        $input = $this->all();

        $input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING);
        $input['webspace_id'] = filter_var($input['webspace_id'], FILTER_SANITIZE_NUMBER_INT);

        $this->replace($input);
    }
}
