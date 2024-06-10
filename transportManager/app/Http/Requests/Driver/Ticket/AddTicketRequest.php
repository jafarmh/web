<?php

namespace App\Http\Requests\Driver\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class AddTicketRequest extends FormRequest
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
            "title"=>['required','string','min:3'],
            "file"=>"sometimes|required|mimes:jpeg,jpg,png,mp4,doc,docx,ppt,pptx,txt,pd,xlsx,xls,pdf|max:15000",
            "text"=>['required','string','min:3']


        ];
    }
}
