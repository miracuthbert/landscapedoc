<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostFormRequest extends FormRequest
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
            'title' => [
                'required', 'max:255',
            ],
            'excerpt' => [
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
