<?php

namespace RELSIAFI\Models;

use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    protected $table  = 'RELSIAFI.localizacao';
    protected $primaryKey = 'id_localizacao';

    public $timestamps = false;

    public function tipos_arquivo() {
        return $this->belongsTo('RELSIAFI\Models\TipoArquivo', 'id_localizacao', 'id_localizacao');
    }
}
