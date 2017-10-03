<?php

namespace RELSIAFI\Models;

use \DB as DB;
use Illuminate\Database\Eloquent\Model;

class Extracao extends Model
{
    protected $table  = 'RELSIAFI.extracao';
    protected $primaryKey = 'id_extracao';

    public $timestamps = false;

    public function scopeAtivo($query) {
        return $query->where('st_ativo', 'A');
    }

    public function scopeInativo($query) {
        return $query->where('st_ativo', 'I');
    }

    public function setSgExtracaoAttribute($value) {
        $this->attributes['sg_extracao'] = strtoupper($value);
    }

    public function tipos_arquivo() {
        return $this->hasMany('RELSIAFI\Models\TipoArquivo', 'id_extracao', 'id_extracao');
    }

    public function auditorias() {
        return $this->belongsToMany('RELSIAFI\Models\Auditoria', 'id_extracao', 'id_extracao');
    }

    public static function getMilheiros(\Date $mesAno, Extracao $extracao = null) {
        $query = DB::table('RELSIAFI.extracao')
            ->select(DB::raw('SUM(qtd_linhas) as linhas'))
            ->join('RELSIAFI.tipo_arquivo', 'extracao.id_extracao', '=', 'tipo_arquivo.id_extracao')
            ->join('RELSIAFI.arquivo_recebido', 'arquivo_recebido.id_tipo_arquivo', '=', 'tipo_arquivo.id_tipo_arquivo')
            ->whereRaw('to_char(dt_recebimento, \'mm-YYYY\') = \'' . $mesAno->format('m-Y') . '\'');

        if($extracao != null) {
            $query->where('extracao.id_extracao', $extracao->id_extracao);
        }

        return $query;
    }

    public static function getMilheirosPeriodo(Extracao $extracao, \Date $dia) {
        $query = DB::table('RELSIAFI.extracao')
            ->select(DB::raw('SUM(qtd_linhas) as linhas'))
            ->join('RELSIAFI.tipo_arquivo', 'extracao.id_extracao', '=', 'tipo_arquivo.id_extracao')
            ->join('RELSIAFI.arquivo_recebido', 'arquivo_recebido.id_tipo_arquivo', '=', 'tipo_arquivo.id_tipo_arquivo')
            ->where('extracao.id_extracao', $extracao->id_extracao)
            ->whereRaw('to_char(dt_recebimento, \'YYYY-mm-dd\') = \'' . $dia->format('Y-m-d') . '\'');

        return $query;
    }
}
