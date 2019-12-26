<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteRequest extends FormRequest
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

        //$regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $regex = '/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/';

        return [
            'url' => ['required', 'regex:'.$regex, 'max:255'],
            //'platform' => ['required', 'integer'],
        ];
    }

    public function sanitize(){
        $input = $this->all();

        // input fields here eg,
        $input['url'] = filter_var($input['url'], FILTER_SANITIZE_STRING);
        //$input['platform'] = filter_var($input['platform'], FILTER_SANITIZE_NUMBER_INT);

        $this->replace($input);
    }

    public function messages(){
        return [
            'url.required' => 'URL is required',
            'url.regex' => 'Please input a valid URL',
            //'platform.required' => 'You should choose a platform',
        ];
    }
}
