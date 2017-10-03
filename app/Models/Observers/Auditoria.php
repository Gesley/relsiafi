<?php

namespace RELSIAFI\Models\Observers;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class Auditoria
{
    public function creating(Eloquent $model) {
        $model->dt_execucao = Carbon::now();
    }
}
