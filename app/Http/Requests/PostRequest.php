<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\HttpResponses;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
{
    use HttpResponses;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=> 'required',
            'content'=>'required',
            'category'=>'required',
            'tags'=>'required',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'content.required' => 'Content is required',
            'category.required' => 'Category is required',
            'tags.required' => 'Tags is required',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $data = [
            $errors->messages(),
        ];

        throw new HttpResponseException( $this->validation(false, $data, 'Validation Fails', 422));
    }
}
