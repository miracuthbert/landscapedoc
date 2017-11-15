<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceFormRequest extends FormRequest
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
            'name' => [
                'required', 'max:100',
            ],
            'areas.*' => [
                'required',
            ],
            'price' => [
                'required', 'numeric',
            ],
            'overview' => [
                'required', 'max: 160',
            ],
            'body' => [
                'required',
            ],
            'image' => ['nullable'],
            'category' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('status', true)->whereNotNull('parent_id');
                }),
            ],
            'status' => [
                'required', 'boolean'
            ],
        ];
    }
}
