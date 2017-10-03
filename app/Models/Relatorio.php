<?php

namespace RELSIAFI\Models;

use Illuminate\Database\Eloquent\Model;
use \DB as DB;
use RELSIAFI\Models\Gemeos as GemeosModel;
use RELSIAFI\Models\ArquivoRecebido as ArquivoRecebidoModel;
use RELSIAFI\Models\Extracao as ExtracaoModel;


class Relatorio extends Model
{
    public $timestamps = false;
    const VALOR_UNIDADE = 5.56;

    private static $formatos = [
        1 => 'PDF(Portable Document Format)',
        2 => 'Planilha Eletrônica(Excel)'
    ];

    private static $relatorios = [
        1 => [
            'view' => 'relatorio.1_extracao-de-dados',
            'desc' => 'Relatório extração de dados SIAFI operacional',
            'repository' => 'extracaoDeDados'
        ],
        2 => [
            'view' => 'relatorio.2_prestacao-de-contas_extracao-de-dados',
            'desc' => 'Relatório Prestação de Contas – Extração dos dados SIAFI Operacional',
            'repository' => 'prestacaoDeContas'
        ],
        3 => [
            'view' => 'relatorio.3_consolidado-das-extracoes-de-dados',
            'desc' => 'Relatório Consolidado das Extrações de dados SIAFI Operacional',
            'repository' => 'consolidadoExtrataoDeDados'
        ],
        4 => [
            'view' => 'relatorio.3-1_extracao-de-carga-incremental',
            'desc' => 'Relatório da Extração de Carga Incremental – SIAFI Operacional',
            'repository' => 'extracaoDeCargaIncremental'
        ],
        5 => [
            'view' => 'relatorio.4_demostrativo-de-faturamento',
            'desc' => 'Relatório Demonstrativo de Faturamento – Ministério da Integração Nacional',
            'repository' => 'demonstrativoFaturamento'
        ]
    ];

    public static function getRelatorio($id) {
        if(isset(self::$relatorios[$id])) {
            return self::$relatorios[$id];
        }

        return false;
    }

    public static function getFormato($id) {
        if(isset(self::$formatos[$id])) {
            return self::$formatos[$id];
        }

        return false;
    }

    public static function getMonthsRange() {
        $inicio = \Date::createFromFormat('Y-m-d', GemeosModel::getPeriodoContrato()->inicio_contrato)->startOfMonth();
        $final = \Date::createFromFormat('Y-m-d', GemeosModel::getPeriodoContrato()->final_contrato)->startOfMonth();
        $mes_atual=$inicio;
        $months_range = [];

        while(true) {
            $months_range[$mes_atual->format('m-Y')]['meslongo_ano'] = mb_strtoupper($mes_atual->format('F/Y'));
            $months_range[$mes_atual->format('m-Y')]['mescurto_ano'] = mb_strtoupper($mes_atual->format('M/Y'));
            $months_range[$mes_atual->format('m-Y')]['mescurto'] = mb_strtoupper($mes_atual->format('M'));
            $mes_atual = $mes_atual->add( new \DateInterval('P1M'));
            if($mes_atual > $final) break;
        }

        return $months_range;
    }

    public static function extracaoDeDados($options) {
        $return['total'] = 0;

        foreach ($options[0]['movimentacao'] as $periodo => $valor) {
            $return['data'][$periodo]['inicial'] = \Date::createFromTimestamp(strtotime($valor['inicial']))->format('d/m/Y');
            $return['data'][$periodo]['final'] = \Date::createFromTimestamp(strtotime($valor['final']))->format('d/m/Y');
            $return['data'][$periodo]['franquia'] = GemeosModel::getFranquia(\Date::createFromTimestamp(strtotime($valor['inicial'])));
            $return['data'][$periodo]['milheiros'] = ArquivoRecebidoModel::periodo(\Date::createFromTimestamp(strtotime($valor['inicial'])), \Date::createFromTimestamp(strtotime($valor['final'])))->sum('qtd_linhas');
            $return['data'][$periodo]['valor_unidade'] = self::VALOR_UNIDADE;
            $return['data'][$periodo]['valor_faturado'] = $return['data'][$periodo]['franquia'] * $return['data'][$periodo]['valor_unidade'];

            if($return['data'][$periodo]['milheiros'] > 0) {
                $dividendo = $return['data'][$periodo]['milheiros'] / $return['data'][$periodo]['franquia'];

                if($dividendo >= 1) {
                     $return['data'][$periodo]['valor_faturado'] = $dividendo * $return['data'][$periodo]['franquia'] * self::VALOR_UNIDADE;
                } else {
                     $return['data'][$periodo]['valor_faturado'] = $return['data'][$periodo]['franquia'] * self::VALOR_UNIDADE;
                }
            } else {
                 $return['data'][$periodo]['valor_faturado'] = 0;
            }
            $return['total'] += $return['data'][$periodo]['valor_faturado'];

        }

        return $return;
    }

    public static function prestacaoDeContas() {
        $return = [];

        $statement = DB::table('RELSIAFI.arquivo_recebido')
            ->select(
                DB::raw('to_char(dt_recebimento, \'mm-YYYY\') as mes'),
                DB::raw('sum(qtd_linhas) as quantidade_linhas')
            )
            ->groupBy('to_char(dt_recebimento, \'mm-YYYY\')')
            ->get();

        $return = self::getMonthsRange();
        $mes_contratado = 1;

        foreach ($return as $month => $dummy) {

            $return[$month]['linhas'] = 0;
            $return[$month]['valor_faturado'] = 0;
            $return[$month]['valor_estimado'] = 0;
            $return[$month]['mes_contratado'] = $mes_contratado++;

            foreach ($statement as $arquivos) {
                if($arquivos->mes == $month) {
                    $return[$month]['linhas'] = $arquivos->quantidade_linhas;
                }
            }

            foreach (GemeosModel::getAllFranquias() as $franquia) {
                $return[$month]['franquia'] = $franquia->poresforco;
                $return[$month]['valor_estimado'] = $franquia->poresforco * self::VALOR_UNIDADE;
                $return[$month]['valor_acumulado'] = 0;
                $return[$month]['milheiros'] = 0;

                $return[$month]['acumulado']['valor_estimado'] = 0;
                $return[$month]['acumulado']['valor_faturado'] = 0;
                $return[$month]['acumulado']['franquia'] = 0;
                $return[$month]['acumulado']['linhas'] = 0;
                $return[$month]['acumulado']['milheiros'] = 0;

                if($return[$month]['linhas'] > 0) {
                    $dividendo = $return[$month]['linhas'] / $franquia->poresforco;

                    if($dividendo >= 1) {
                        $return[$month]['valor_faturado'] = $dividendo * $franquia->poresforco * self::VALOR_UNIDADE;
                    } else {
                        $return[$month]['valor_faturado'] = $franquia->poresforco * self::VALOR_UNIDADE;
                    }
                } else {
                    $return[$month]['valor_faturado'] = 0;
                }
            }

            if( ! isset($mes_anterior)) {
                $return[$month]['acumulado']['franquia'] = $return[$month]['franquia'];
                $return[$month]['acumulado']['linhas'] = $return[$month]['linhas'];
                $return[$month]['acumulado']['milheiros'] = $return[$month]['milheiros'];
                $return[$month]['acumulado']['valor_estimado'] = $return[$month]['valor_estimado'];
                $return[$month]['acumulado']['valor_faturado'] = $return[$month]['valor_faturado'];
            } else {
                if(isset($return[$month]['acumulado']['franquia'])) {
                    $return[$month]['acumulado']['franquia'] = $return[$mes_anterior]['acumulado']['franquia'] + $return[$month]['franquia'];
                }
                if(isset($return[$month]['acumulado']['linhas'])) {
                    $return[$month]['acumulado']['linhas'] = $return[$mes_anterior]['acumulado']['linhas'] + $return[$month]['linhas'];
                }

                if(isset($return[$month]['acumulado']['valor_estimado'])) {
                    $return[$month]['acumulado']['valor_estimado'] = $return[$mes_anterior]['acumulado']['valor_estimado'] + $return[$month]['valor_estimado'];
                }

                if(isset($return[$month]['acumulado']['valor_faturado'])) {
                    $return[$month]['acumulado']['valor_faturado'] = $return[$mes_anterior]['acumulado']['valor_faturado'] + $return[$month]['valor_faturado'];
                }
            }

            $mes_anterior = $month;
        }

        return $return;
    }

    public static function consolidadoExtrataoDeDados() {

        foreach (ExtracaoModel::all() as $extracao) {
            foreach (self::getMonthsRange() as $month => $dummy) {
                $return['data'][$extracao->id_extracao]['extracao'] = $extracao->nm_extracao;

                $return['data'][$extracao->id_extracao]['data'][$month]['total']['geral'] = ((isset($return['data'][$extracao->id_extracao]['data'][$month]['total']['geral'])) ? $return['data'][$extracao->id_extracao]['data'][$month]['total']['geral'] : 0);
                $return['data'][$extracao->id_extracao]['data'][$month]['total']['milheiro'] = ((isset($return['data'][$extracao->id_extracao]['data'][$month]['total']['milheiro'])) ? $return['data'][$extracao->id_extracao]['data'][$month]['total']['milheiro'] : 0);
                $return['data'][$extracao->id_extracao]['total']['geral'] = ((isset($return['data'][$extracao->id_extracao]['total']['geral'])) ? $return['data'][$extracao->id_extracao]['total']['geral'] : 0);
                $return['total']['geral'] = ((isset($return['total']['geral'])) ? $return['total']['geral'] : 0);
                $return['total']['milheiros'] = ((isset($return['total']['milheiros'])) ? $return['total']['milheiros'] : 0);

                $milheiros = ExtracaoModel::getMilheiros(\Date::createFromFormat('d-m-Y', '01-' . $month), $extracao);

                if($milheiros->count()) {
                    $return['data'][$extracao->id_extracao]['data'][$month]['milheiros'] = $milheiros->first()->linhas;
                    $return['data'][$extracao->id_extracao]['data'][$month]['total']['geral'] += $return['data'][$extracao->id_extracao]['data'][$month]['milheiros'];
                    $return['data'][$extracao->id_extracao]['data'][$month]['total']['milheiro'] = $return['data'][$extracao->id_extracao]['data'][$month]['total']['geral'] / 1000;

                    $return['data'][$extracao->id_extracao]['total']['geral'] += $return['data'][$extracao->id_extracao]['data'][$month]['milheiros'];
                    $return['total']['geral'] += $return['data'][$extracao->id_extracao]['data'][$month]['milheiros'];
                } else {
                    $return['data'][$extracao->id_extracao]['data'][$month]['milheiros'] = $milheiros->count();
                }
            }
        }

        $return['total']['milheiros'] = $return['total']['geral'] / 1000;
        $return['date'] = self::getMonthsRange();

        return $return;
    }

    public static function extracaoDeCargaIncremental($options) {
        $return = null;


        foreach ($options[0]['movimentacao'] as $periodo => $valor) {
            $inicial = \Date::createFromTimestamp(strtotime($valor['inicial']));
            $final = \Date::createFromTimestamp(strtotime($valor['final']));
            $dia = $inicial;

            while(true) {

                $return['data'][$periodo]['data'][$dia->timestamp]['recebido'] = \Date::createFromTimestamp($dia->timestamp)->sub( new \DateInterval('P1D'))->timestamp;
                $return['data'][$periodo]['data'][$dia->timestamp]['movimento'] = $dia->timestamp;

                foreach (Extracao::all() as $extracao) {
                    $return['total']['extracao'][$extracao->id_extracao] = ((isset($return['total']['extracao'][$extracao->id_extracao]))? $return['total']['extracao'][$extracao->id_extracao] : 0);

                    $return['extracoes'][$extracao->id_extracao] = $extracao->nm_extracao;

                    $linhas = ExtracaoModel::getMilheirosPeriodo($extracao,  $dia);

                    if($linhas->count()) {
                        $return['data'][$periodo]['data'][$dia->timestamp]['linhas'][$extracao->id_extracao] = $linhas->first()->linhas;
                        $return['total']['extracao'][$extracao->id_extracao] += $linhas->first()->linhas;
                    } else {
                        $return['data'][$periodo]['data'][$dia->timestamp]['linhas'][$extracao->id_extracao] = $linhas->count();
                    }
                }

                if($dia > $final) break;

                $dia->add( new \DateInterval('P1D'));
            }
        }
        // dd($return);

        return $return;
    }

    public static function demonstrativoFaturamento() {
        $return['date'] = self::getMonthsRange();
        $return['total']['ano'] = 0;
        $return['total']['contrato'] = 0;

        foreach (self::getMonthsRange() as $month => $dummy) {
            $linhas = ExtracaoModel::getMilheiros(\Date::createFromFormat('d-m-Y', '01-' . $month));

            if($linhas->count()) {
                $return['data'][$month]['linhas'] = $linhas ->first()->linhas;
                $return['total']['ano'] += $return['data'][$month]['linhas'];
            } else {
                $return['data'][$month]['linhas'] = $linhas->count();
            }
        }

        return $return;
    }
}
