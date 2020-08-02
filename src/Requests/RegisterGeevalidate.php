<?php

namespace Cirlmcesc\LaravelGeevalidate\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterGeevalidate extends FormRequest
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
            'client_type' => ["required", "in:web,h5,web_view,native,unknown"],
        ];
    }
}
