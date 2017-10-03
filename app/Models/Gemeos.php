<?php

namespace RELSIAFI\Models;

use Illuminate\Database\Eloquent\Model;
use \Config as Config;
use \DB as DB;

class Gemeos extends Model
{

    public static function getContrato() {
        return DB::connection('gemeos')
            ->table('basico_contrato')
            ->where('idcontrato', Config::get('gemeos.idcontrato'))
            ->first();
    }

    public static function getAllFranquias() {
        return DB::connection('gemeos')
            ->table('projeto_distribuicao')
            ->select(['poresforco', 'dtentrega'])
            ->join('projeto', 'projeto.idprojeto', '=', 'projeto_distribuicao.idprojeto')
            ->join('distribuicao_os', 'distribuicao_os.idprojeto', '=', 'projeto_distribuicao.idprojeto')
            ->groupBy('dtentrega')
            ->where('idcontrato', Config::get('gemeos.idcontrato'))
            ->orderBy('dtentrega')
            ->get();
    }

    public static function getFranquia(\Date $data) {
        $mesAno = $data->format('m-Y');

        return DB::connection('gemeos')
            ->table('projeto_distribuicao')
            ->select(['poresforco'])
            ->join('projeto', 'projeto.idprojeto', '=', 'projeto_distribuicao.idprojeto')
            ->join('distribuicao_os', 'distribuicao_os.idprojeto', '=', 'projeto_distribuicao.idprojeto')
            ->where('idcontrato', Config::get('gemeos.idcontrato'))
            ->whereRaw('DATE_FORMAT(dtentrega, "%m-%Y") = "' .  $mesAno . '"')
            ->first();
    }

    public static function getPeriodoContrato() {
       return DB::connection('gemeos')
            ->table('projeto_distribuicao')
            ->select(DB::raw('MIN(dtentrega) as inicio_contrato, MAX(dtentrega) as final_contrato'))
            ->join('projeto', 'projeto.idprojeto', '=', 'projeto_distribuicao.idprojeto')
            ->join('distribuicao_os', 'distribuicao_os.idprojeto', '=', 'projeto_distribuicao.idprojeto')
            ->where('idcontrato', Config::get('gemeos.idcontrato'))
            ->orderBy('dtentrega')
            ->first();
    }

    public static function getMilheiro() {
        return DB::connection('gemeos')
            ->table('basico_contrato_elemento')
            ->select(['*'])
            ->where('idcontrato', Config::get('gemeos.idcontrato'))
            ->get();
    }

    public static function getVigencia() {
        return [
            'inicio' => date('d/m/Y', strtotime(self::getContrato()->dtinicio)),
            'fim' =>date('d/m/Y', strtotime(self::getContrato()->dtfim)),
        ];
    }
}
