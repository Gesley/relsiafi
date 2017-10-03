<?php

namespace RELSIAFI\Http\Requests;

use RELSIAFI\Http\Requests\Request;

class TipoArquivo extends Request
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
            'id_extracao' => 'required|numeric',
            'id_localizacao' => 'required|numeric',
            'sg_tipo_arquivo' => 'required|unique:relsiafi.tipo_arquivo,sg_tipo_arquivo,'.$this->id_tipo_arquivo.',id_tipo_arquivo|alpha|max:5',
            'nm_tipo_arquivo' => 'required|max:50',
            'ds_expressao_regular' => 'required|unique:relsiafi.tipo_arquivo,ds_expressao_regular,'.$this->id_tipo_arquivo.',id_tipo_arquivo|regex_test|max:100',
        ];
    }
}
