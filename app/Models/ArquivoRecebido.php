<?php

namespace RELSIAFI\Models;

use Illuminate\Database\Eloquent\Model;

class ArquivoRecebido extends Model
{
    protected $table  = 'RELSIAFI.arquivo_recebido';
    protected $primaryKey = 'id_arquivo_recebido';

    public $timestamps = false;

    public function scopePeriodo($query, \Date $inicial, \Date $final) {
        return $query->where('dt_recebimento', '>=', $inicial->format('Y-m-d'))
            ->where('dt_recebimento', '<=', $final->format('Y-m-d'));
    }

    public function tipo_arquivo() {
        return $this->hasOne('RELSIAFI\Models\TipoArquivo', 'id_tipo_arquivo', 'id_tipo_arquivo');
    }
}
