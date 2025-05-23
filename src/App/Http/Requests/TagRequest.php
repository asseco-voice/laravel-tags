<?php

declare(strict_types=1);

namespace Asseco\Tags\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:tags,name' . ($this->tag ? ',' . $this->tag->id : null),
            'is_system' => 'boolean',
            'color' => 'nullable|string|max:30',
        ];
    }
}
