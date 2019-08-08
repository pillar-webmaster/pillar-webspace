<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebspaceRequest extends FormRequest
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

        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        return [
            'name' => ['required', 'max:255', 'alpha_num'],
            'url' => ['required', 'regex:'.$regex, 'max:255'],
            'mode' => ['required', 'integer'],
            'service' => ['required', 'integer'],
            'platform_id' => ['required', 'integer'],
            'owner' => ['required','array','min:1'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function sanitize(){
        $input = $this->all();

        // input fields here eg,
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['url'] = filter_var($input['url'], FILTER_SANITIZE_URL);
        $input['mode'] = filter_var($input['mode'], FILTER_SANITIZE_NUMBER_INT);
        $input['service'] = filter_var($input['service'], FILTER_SANITIZE_NUMBER_INT);
        $input['platform_id'] = filter_var($input['platform_id'], FILTER_SANITIZE_NUMBER_INT);
        if (isset($input['owner']))
            $input['owner'] = filter_var_array($input['owner'], FILTER_SANITIZE_NUMBER_INT);
        //$input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING);
        $input['description'] = clean($input['description']);

        $this->replace($input);
    }

    public function messages(){
        return [
            'owner.required' => 'You should select at least one owner',
            'mode.required' => 'You should select a status',
            'service.required' => 'You should select a service level',
            'platform.required' => 'You should select a platform',
        ];
    }
}
