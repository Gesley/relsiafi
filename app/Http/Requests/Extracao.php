<?php

namespace RELSIAFI\Http\Requests;

use RELSIAFI\Http\Requests\Request;

class Extracao extends Request
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
            'sg_extracao' => 'required|max:2',
            'nm_extracao' => 'required|max:8',
            'ds_extracao' => 'required|max:100'
        ];
    }
}
