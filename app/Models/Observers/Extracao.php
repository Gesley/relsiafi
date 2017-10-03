<?php

namespace RELSIAFI\Models\Observers;

use Illuminate\Database\Eloquent\Model as Eloquent;
use RELSIAFI\Models\TipoArquivo as TipoArquivoModel;

class Extracao
{
    public function updating(Eloquent $model)
    {
        if(isset($model->getDirty()['st_ativo'])) {
            TipoArquivoModel::where('id_extracao', $model->id_extracao)->update(['st_ativo' => $model->st_ativo]);
        }

        return true;
    }
}
