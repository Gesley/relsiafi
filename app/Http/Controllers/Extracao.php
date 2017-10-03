<?php

namespace RELSIAFI\Http\Controllers;

use Illuminate\Http\Request;

use RELSIAFI\Http\Requests;
use RELSIAFI\Http\Controllers\Controller;

use RELSIAFI\Http\Requests\Extracao as ExtracaoRequest;
use RELSIAFI\Models\Extracao as ExtracaoModel;

class Extracao extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('extracao/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('extracao/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ExtracaoRequest $request)
    {
        $extracao = ExtracaoModel::where('sg_extracao', $request->input('sg_extracao'))
                                    ->orWhere('nm_extracao', $request->input('nm_extracao'));

        if($extracao->count() === 0){

            try {
                $extracao = new ExtracaoModel;
                $extracao->sg_extracao = $request->input('sg_extracao');
                $extracao->nm_extracao = $request->input('nm_extracao');
                $extracao->ds_extracao = $request->input('ds_extracao');

                if($extracao->save()) {
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

        } else {
            return response()->json([
                'type' => 'info',
                'message' => trans('errors.field_already_exists', ['field_name' => 'Extracao'])
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
        return view('extracao/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $extracao = ExtracaoModel::findOrFail($id);
            $extracao->sg_extracao = $request->input('sg_extracao');
            $extracao->nm_extracao = $request->input('nm_extracao');
            $extracao->ds_extracao = $request->input('ds_extracao');
            $extracao->st_ativo = $request->input('st_ativo');

            if($extracao->save()) {
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
            $extracao = ExtracaoModel::findOrFail($id);
            $extracao->st_ativo = 'I';

            if($extracao->save()) {
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
