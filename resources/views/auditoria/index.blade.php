<form name="ConsultarLogForm" id="ConsultarLogForm">
    <fieldset>
        <legend>Consultar Auditoria</legend>

        <div class="form-group col-lg-3">
            <label for="id_tipo_arquivo" class="control-label">Tipo de Arquivo</label>
            <div>
                <select class="form-control" name="id_tipo_arquivo" id="id_tipo_arquivo" ng-model="filtro_auditoria.id_tipo_arquivo" ng-options="tipo_arquivo.id_tipo_arquivo as (tipo_arquivo.sg_tipo_arquivo + ' - ' + tipo_arquivo.nm_tipo_arquivo) for tipo_arquivo in tiposArquivo track by tipo_arquivo.id_tipo_arquivo" ng-required="true">
                    <option selected="selected" value="">Todos</option>
                </select>
            </div>
        </div>

        <div class="form-group col-lg-3">
            <label for="dt_inicial" class="control-label">Data Inicial</label>
            <div class="input-group">
                <input type="text" name="dt_inicial" id="dt_inicial" class="form-control" datepicker-popup="dd/MM/yyyy" ng-model="filtro_auditoria.dataInicial" ng-required="true" show-button-bar="false" show-weeks="false" is-open="dataInicial.focus" ng-focus="dataInicial.focus = true" ng-change="filtro_auditoria.dataFinal = undefined" min-date="startDate" max-date="limitDate"/>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-click="dataInicial.focus = true"><i class="fa fa-calendar"></i></button>
                </span>
            </div>
        </div>

        <div class="form-group col-lg-3">
            <label for="dt_final" class="control-label">Data Final</label>
            <div class="input-group">
                <input type="text" name="dt_final" id="dt_final" class="form-control" datepicker-popup="dd/MM/yyyy" ng-model="filtro_auditoria.dataFinal" ng-required="true" min-date="filtro_auditoria.dataInicial" show-button-bar="false" show-weeks="false" is-open="dataFinal.focus" ng-focus="dataFinal.focus = true" ng-disabled="!filtro_auditoria.dataInicial" max-date="limitDate"/>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-click="dataFinal.focus = true"><i class="fa fa-calendar"></i></button>
                </span>
            </div>
        </div>

        <div class="form-group col-lg-3">
            <label for="id_execucao_status" class="control-label">Status da Execução</label>
            <div>
                <select class="form-control" id="id_execucao_status" name="id_execucao_status" ng-model="filtro_auditoria.st_execucao_status" ng-options="status.id_execucao_status as status.nm_execucao_status for status in execucao_status track by status.id_execucao_status" ng-required="true">
                    <option selected="selected" value="">Todos</option>
                </select>
            </div>
        </div>
    </fieldset>
</form>
<hr />
<table class="table table-striped auditorias">
    <thead>
        <th>Extração</th>
        <th>Tipo de Arquivo</th>
        <th>Data do Arquivo</th>
        <th>Credencial</th>
        <th>Data da Execução</th>
        <th>Horário da Execução</th>
        <th>Status da Execução</th>
    </thead>
    <tbody>
        <tr ng-repeat="auditoria in filtro = (auditorias | orderBy: '-dt_execucao' |  filter: {id_tipo_arquivo : filtro_auditoria.id_tipo_arquivo} : true | filter : {'id_execucao_status' : filtro_auditoria.st_execucao_status} : true | dateRange: 'dt_execucao' : filtro_auditoria.dataInicial : filtro_auditoria.dataFinal)" ng-class="{
            'success': auditoria.status.id_execucao_status == '1',
            'danger': auditoria.status.id_execucao_status == '2',
            'info': auditoria.status.id_execucao_status == '3'
        }">

            <td>@{{auditoria.tipo_arquivo.extracao.sg_extracao}} - @{{auditoria.tipo_arquivo.extracao.nm_extracao}}</td>
            <td><span tooltip="@{{auditoria.tipo_arquivo.localizacao.nm_localizacao}}">@{{auditoria.tipo_arquivo.sg_tipo_arquivo}} - @{{auditoria.tipo_arquivo.nm_tipo_arquivo}}</span></td>
            <td>
                <span ng-if="auditoria.arquivo_recebido != null">@{{ auditoria.arquivo_recebido.dt_recebimento | date: 'dd/MM/yyyy'}}</span>
                <span ng-if="auditoria.arquivo_recebido == null"> - </span>
            </td>
            <td>@{{auditoria.credencial.ds_nome}}</td>
            <td>@{{auditoria.dt_execucao | date: 'dd/MM/yyyy'}}</td>
            <td>@{{auditoria.dt_execucao | date: 'HH:mm'}}</td>
            <td>
                <span ng-if="auditoria.status.id_execucao_status == 1" popover="@{{auditoria.arquivo_recebido.nm_arquivo}} - @{{auditoria.arquivo_recebido.qtd_linhas}} linhas" popover-trigger="mouseenter">@{{auditoria.status.nm_execucao_status}}</span>
                <span ng-if="auditoria.status.id_execucao_status == 2" popover="O arquivo não foi encontrado!" popover-trigger="mouseenter">@{{auditoria.status.nm_execucao_status}}</span>
                <span ng-if="auditoria.status.id_execucao_status == 3"> @{{auditoria.status.nm_execucao_status}} </span>

            </td>
        </tr>
        <tr ng-if="filtro.length == 0">
            <td colspan="7" class="text-center">
                Nenhum registro encontrado.
            </td>
        </tr>
    </tbody>
    <tfoot>
        <th>Extração</th>
        <th>Tipo de Arquivo</th>
        <th>Data do Arquivo</th>
        <th>Credencial</th>
        <th>Data da Execução</th>
        <th>Horário da Execução</th>
        <th>Status da Execução</th>
    </tfoot>
</table>

<div class="row-fluid">
    <div class="col-md-2 col-md-offset-10">
        Nº de Registros: @{{ filtro.length }}
    </div>
</div>

