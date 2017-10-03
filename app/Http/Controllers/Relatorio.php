<?php

namespace RELSIAFI\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date as Date;
use \Response as Response;
use RELSIAFI\Http\Requests;
use RELSIAFI\Http\Controllers\Controller;

use RELSIAFI\Models\Gemeos as GemeosModel;
use RELSIAFI\Models\Relatorio as RelatorioModel;

class Relatorio extends Controller
{

    const FORMATO_PDF = 1;
    const FORMATO_XLS = 2;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('relatorio/index');
    }

    public function render(Request $request) {

        $relatorio = RelatorioModel::getRelatorio($request->input('id_relatorio'));

        if( (integer) $request->input('id_formato') == self::FORMATO_PDF) {
            return $this->renderPDF($relatorio, $request->all());
        } elseif( (integer) $request->input('id_formato') == self::FORMATO_XLS) {
            return $this->renderXLS($relatorio, $request->all());
        }

        return false;
    }

    private function renderPDF($relatorio, $options) {
        $pdf = \PDF::loadView($relatorio['view'], [
            'vigencia' => GemeosModel::getVigencia(),
            'contrato' => GemeosModel::getContrato(),
            'opcoes' => $options,
            'repository' => call_user_func(
                ['RELSIAFI\Models\Relatorio', $relatorio['repository']],
                [$options]
            )
        ]);

        return $pdf
            ->setOrientation('landscape')
            ->setOption('margin-bottom', 0)
            ->download('relatorio.pdf');
    }

    private function renderXLS($relatorio, $options) {
        $headers = array(
            'Pragma' => 'public',
            'Expires' => 'public',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Cache-Control' => 'private',
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=file.xls',
            'Content-Transfer-Encoding' => 'binary',
            'charset' => 'utf-8'
        );

        return Response::make(view($relatorio['view'],[
            'vigencia' => GemeosModel::getVigencia(),
            'contrato' => GemeosModel::getContrato(),
            'opcoes' => $options,
            'repository' => call_user_func(
                ['RELSIAFI\Models\Relatorio', $relatorio['repository']],
                [$options]
            )
        ]), 200, $headers);
    }
}
