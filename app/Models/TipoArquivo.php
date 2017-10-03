<?php

namespace RELSIAFI\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Collection as Collection;

class TipoArquivo extends Model
{
    protected $table  = 'RELSIAFI.tipo_arquivo';
    protected $primaryKey = 'id_tipo_arquivo';

    public $timestamps = false;

    public function scopeAtivo($query) {
        return $query->where('st_ativo', 'A');
    }

    public function scopeInativo($query) {
        return $query->where('st_ativo', 'I');
    }

    public function setSgTipoArquivoAttribute($value) {
        $this->attributes['sg_tipo_arquivo'] = strtoupper($value);
    }

    public function extracao() {
        return $this->belongsTo('RELSIAFI\Models\Extracao', 'id_extracao', 'id_extracao');
    }

    public function localizacao() {
        return $this->hasOne('RELSIAFI\Models\Localizacao', 'id_localizacao', 'id_localizacao');
    }

    public function arquivos_recebidos() {
        return $this->hasMany('RELSIAFI\Models\ArquivoRecebido', 'id_tipo_arquivo', 'id_tipo_arquivo');
    }

    public function auditorias() {
        return $this->hasMany('RELSIAFI\Models\Auditoria', 'id_tipo_arquivo');
    }

    public static function naoCapturado($localizacao) {
        return Collection::make(\DB::table('RELSIAFI.tipo_arquivo')
            ->select('tipo_arquivo.*')
            ->leftJoin('RELSIAFI.arquivo_recebido', function($join) {
                $join->on('tipo_arquivo.id_tipo_arquivo', '=', 'arquivo_recebido.id_tipo_arquivo')
                    ->where('arquivo_recebido.dt_recebimento', '=', Carbon::yesterday()->format('Y-m-d'));
            })
            ->whereNull('arquivo_recebido.id_arquivo_recebido')
            ->where('st_ativo', 'A')
            ->where('tipo_arquivo.id_localizacao', $localizacao)->get());
    }
}
