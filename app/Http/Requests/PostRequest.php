<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return [

            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',

        ];
    }



    public function messages()
    {
        return [

            'title.required' => 'Il campo "Titolo" è obbligatorio. Inserire i dati.',

            'title.min' => 'Il campo "Titolo" deve contenere come minino :min caratteri',

            'title.max' => 'Il campo "Titolo" deve contenere al massimo :max caratteri',

            // ------------------------------------------------------------------------------------ //

            'description.required' => 'Il campo "Descrizione" è obbligatorio. Inserire i dati.',

            'description.min' => 'Il campo "Descrizione" deve contenere come minino :min caratteri',

        ];
    }
}
