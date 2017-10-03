<?php

namespace RELSIAFI\Http\Controllers;

use Illuminate\Http\Request;

use RELSIAFI\Http\Requests;
use RELSIAFI\Http\Controllers\Controller;

use RELSIAFI\Http\Requests\TipoArquivo as TipoArquivoRequest;
use RELSIAFI\Models\TipoArquivo as TipoArquivoModel;

class TipoArquivo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('tipo_arquivo/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_arquivo/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TipoArquivoRequest $request)
    {
        try {
            $tipo_arquivo = new TipoArquivoModel;
            $tipo_arquivo->id_extracao = $request->input('id_extracao');
            $tipo_arquivo->id_localizacao = $request->input('id_localizacao');
            $tipo_arquivo->sg_tipo_arquivo = $request->input('sg_tipo_arquivo');
            $tipo_arquivo->nm_tipo_arquivo = $request->input('nm_tipo_arquivo');
            $tipo_arquivo->ds_expressao_regular = $request->input('ds_expressao_regular');

            if($tipo_arquivo->save()) {
                return response()->json([
                    'type' => 'success',
                    'message' => trans('info.insert_success')
                ]);
            }
        } catch(Exception $e) {
                return response()->json([
                    'type' => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit()
    {
        return view('tipo_arquivo/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(TipoArquivoRequest $request, $id)
    {
        try {
            $tipo_arquivo = TipoArquivoModel::findOrFail($id);

            foreach ($request->input() as $key => $value) {
                if($key !== 'id_tipo_arquivo') {
                        $tipo_arquivo->$key = $value;
                }
            }

            if($tipo_arquivo->save()) {
                return response()->json([
                    'type' => 'success',
                    'message' => trans('info.update_success')
                ]);
            }

        } catch(Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $tipo_arquivo = TipoArquivoModel::findOrFail($id);
            $tipo_arquivo->st_ativo = 'I';

            if($tipo_arquivo->save()) {
                return response()->json([
                    'type' => 'info',
                    'message' => trans('info.delete_success')
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }
}
