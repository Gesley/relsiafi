<?php

namespace RELSIAFI\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Auditoria extends Model
{
    protected $table  = 'RELSIAFI.auditoria';
    protected $primaryKey = 'id_auditoria';

    public $timestamps = false;

    public function scopeData($query, Carbon $date) {
        return $query->whereRaw('to_char(dt_execucao, "YYYY-mm-dd") = ?', [$date->toDateString()]);
    }

    public function scopeTipoArquivo($query, $tipo_arquivo) {
        return $query->where('id_tipo_arquivo', $tipo_arquivo);
    }

    public function getDtExecucaoAttribute($value) {
       return date('U', strtotime($value)) * 1000;
    }

    public function credencial() {
        return $this->hasOne('RELSIAFI\Models\Credencial', 'id_credencial', 'id_credencial');
    }

    public function tipo_arquivo() {
        return $this->hasOne('RELSIAFI\Models\TipoArquivo', 'id_tipo_arquivo', 'id_tipo_arquivo');
    }

    public function status() {
        return $this->hasOne('RELSIAFI\Models\ExecucaoStatus', 'id_execucao_status', 'id_execucao_status');
    }

    public function arquivo_recebido() {
        return $this->hasOne('RELSIAFI\Models\ArquivoRecebido', 'id_arquivo_recebido', 'id_arquivo_recebido');
    }
}
