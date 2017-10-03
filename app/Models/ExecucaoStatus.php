<?php

namespace RELSIAFI\Models;

use Illuminate\Database\Eloquent\Model;

class ExecucaoStatus extends Model
{
    protected $table  = 'RELSIAFI.execucao_status';
    protected $primaryKey = 'id_execucao_status';

    public $timestamps = false;

    public function auditorias() {
        return $this->belongsToMany('RELSIAFI\Models\Auditoria', 'id_execucao_status', 'id_execucao_status');
    }
}
