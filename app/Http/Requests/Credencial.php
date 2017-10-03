<?php

namespace RELSIAFI\Http\Requests;

use RELSIAFI\Http\Requests\Request;

class Credencial extends Request
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
            'nm_usuario' => 'required|max:100',
            'ds_nome'     => 'required|max:200',
            'ds_email'    => 'required|email',
            'ds_senha' => 'required',
            'nr_cpf'      => 'required|max:11'
        ];
    }
}
