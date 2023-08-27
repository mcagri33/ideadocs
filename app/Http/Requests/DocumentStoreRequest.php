<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
      return [
        'document_name' => ['required'],
        'file' => ['required', 'file', 'max:300000', 'mimes:pdf,xls,doc,docx,zip,xlsx,xml,rar,jpeg,png,jpg,tif'],
      ];
    }
}
