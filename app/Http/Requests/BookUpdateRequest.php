<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
        if ($this->has('title')) {
            return [
                'title' => 'required'
            ];
        }

        if ($this->has('total')) {
            return [
                'total' => 'required|integer'
            ];
        }

        if ($this->has('book_categories_id')) {
            return [
                'book_categories_id' => 'required|integer'
            ];
        }

        return [];
    }
}
