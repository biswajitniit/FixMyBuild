<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TraderProjectRequest extends BaseRequest
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
            'order_by' => 'nullable|string|max:191',
            'order_by_type' => 'nullable|string|in:desc,asc',
            'limit' => 'nullable|numeric',
            'page' => 'nullable|numeric',
            'new' => 'nullable|boolean',
            'history' => 'nullable|boolean'
        ];
    }
}
