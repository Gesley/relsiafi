<?php

namespace RELSIAFI\Models\Observers;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class ArquivoRecebido
{
    public function creating(Eloquent $model) {
        $model->dt_hora_cadastro = Carbon::now();
    }
}
