<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembersRequest extends FormRequest
{
    protected $dontFlash = ['files'];
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
            'name' => ['required','max:15'], // '필드' =>'검사조건'
            'comments'=> ['required','max:20'],
            'files' => ['array'],
            'files.*'=>['mimes:jpg,png,zip,tar','max:30000'],
        ];
    }
    public function messages()
    {
        return[
            'required'=>':attribute는 필수 입력 항목입니다.',
            // 'min'=>':attribute는 최소 :min 글자 이상이 필요합니다',
            // 'max'=>':attribute는 최대 :max 글자 입니다.',
        ];
    }

    public function attributes(){
        return [
            'name'=>'이름',
            'comments'=>'한마디',
        ];
    }

}


