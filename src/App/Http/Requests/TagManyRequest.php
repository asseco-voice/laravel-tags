<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagManyRequest extends FormRequest
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
            'model' => 'required|string',
            'ids' => 'required|array',
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
        ];
    }
}
