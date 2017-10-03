<?php

namespace RELSIAFI\Http\Controllers;

use Illuminate\Http\Request;

use RELSIAFI\Http\Requests;
use RELSIAFI\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;

use RELSIAFI\Http\Requests\Credencial as CredencialRequest;
use RELSIAFI\Models\LDAP\User as LDAPUser;
use RELSIAFI\Models\Credencial as CredencialModel;

class Credencial extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('credencial/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('credencial/create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit()
    {
        return view('credencial/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CredencialRequest $request)
    {
        $credencial = CredencialModel::where('nm_usuario', $request->input('nm_usuario'));

        if($credencial->count() === 0){

            if( ! CredencialModel::checkCPF($request->input('nr_cpf'))) {

                $CPF = CredencialModel::encryptData($request->input('nr_cpf'));
                $senha = CredencialModel::encryptData($request->input('ds_senha'));

                if(CredencialModel::checkSTA($CPF, $senha)) {
                    try {
                        $credencial = new CredencialModel;
                        $credencial->nm_usuario = $request->input('nm_usuario');
                        $credencial->ds_nome = $request->input('ds_nome');
                        $credencial->ds_email = $request->input('ds_email');
                        $credencial->nr_cpf = $CPF;
                        $credencial->ds_senha = $senha;

                        if($credencial->save()) {
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
                        'type' => 'error',
                        'message' => trans('errors.no_permission')
                    ]);
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'message' => trans('errors.cpf_already_in_use')
                ]);
            }
        } else {
            return response()->json([
                'type' => 'info',
                'message' => trans('errors.field_already_exists', ['field_name' => 'Credencial'])
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $credencial = CredencialModel::find($request->input('id_credencial'));

        if($request->has('nr_cpf') or $request->has('ds_senha')) {
            if($request->has('nr_cpf') and ! ($request->has('nr_cpf') and $request->has('ds_senha'))) {
                $CPF = CredencialModel::encryptData($request->input('nr_cpf'));
                $senha = $credencial->ds_senha;
            } elseif($request->has('ds_senha') and ! ($request->has('nr_cpf') and $request->has('ds_senha'))) {
                $CPF = $credencial->nr_cpf;
                $senha = CredencialModel::encryptData($request->input('ds_senha'));
            } else {
                $CPF = CredencialModel::encryptData($request->input('nr_cpf'));
                $senha = CredencialModel::encryptData($request->input('ds_senha'));
            }

            if( ! CredencialModel::checkSTA($CPF, $senha)) {
                return response()->json([
                    'type' => 'error',
                    'message' => trans('errors.no_permission')
                ]);
            }
        }

        foreach ($request->input() as $key => $value) {
            if($key !== 'id_credencial') {
                if(in_array($key, ['ds_senha', 'nr_cpf'])) {
                    $credencial->$key = CredencialModel::encryptData($value);
                } else {
                    $credencial->$key = $value;
                }
            }
        }

        if($credencial->save()) {
            if($request->has('st_ativo')) {
                $message = trans('info.activated_credential');
            } else {
                $message = trans('info.update_success');
            }

            return response()->json([
                'type' => 'info',
                'message' => $message
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
        $credencial = CredencialModel::findOrFail($id);
        $credencial->st_deletado = 'S';

        if($credencial->save()) {
            return response()->json([
                'type' => 'info',
                'message' => trans('info.delete_success')
            ]);
        }
    }

    public function getAllLDAPUsers() {
        return json_encode(LDAPUser::getAllUsers());
    }
}
