<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'], // '필드' =>'검사조건'
            'content'=> ['required','min:10'],
        ];
    }
    public function messages()
    {
        return[
            'required'=>':attribute는 필수 입력 항목입니다.',
            'min'=>':attribute는 최소 :min 글자 이상이 필요합니다',
        ];
    }

    public function attributes(){
        return [
            'title'=>'제목',
            'content'=>'본문',
        ];
    }
}
