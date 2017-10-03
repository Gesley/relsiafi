<?php

namespace RELSIAFI\Models\Observers;

use Illuminate\Database\Eloquent\Model as Eloquent;
use RELSIAFI\Models\Credencial as CredencialModel;
use Carbon\Carbon;

class Credencial
{
    public function updating(Eloquent $model)
    {
        if(isset($model->getDirty()['st_ativo'])) {
            CredencialModel::where('st_ativo', '=', 'A')->update(['st_ativo' => 'I']);
        }

        return true;
    }

    public function creating(Eloquent $model) {
        $model->dt_criado = Carbon::now();
    }
}
