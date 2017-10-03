<form class="form-horizontal" name="ConsultarExtracoesForm">
    <fieldset>
        <legend>Consultar Extrações</legend>

        <div class="form-group">
            <label for="id_formato" class="col-lg-2 control-label">Formato</label>
            <div class="col-lg-4">
                <select class="form-control" name="id_formato" ng-model="relatorio.id_formato" ng-options="formato.id as formato.desc for formato in formatos track by formato.id" ng-required="true">
                </select>
            </div>

            <label for="id_relatorio" class="col-lg-2 control-label">Tipo de Relatório</label>
            <div class="col-lg-4">
                <select class="form-control" name="id_relatorio" ng-model="relatorio.id_relatorio" ng-options="relatorio.id as relatorio.desc for relatorio in relatorios track by relatorio.id" ng-required="true">
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="mes_relativo" class="col-lg-2 control-label">Mes/Ano Relativo</label>
            <div class="col-lg-3">
                <select class="form-control" name="mes_relativo" ng-model="relatorio.mes_relativo" ng-options="date as (date.month.desc + '/' + date.year) for date in dateRange track by dateRange.indexOf(date)" ng-required="true">
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="movimentacao_inicial[0]" class="col-lg-2 control-label">Período de Movimentação</label>
            <div class="col-lg-3">
                <p class="input-group">
                    <input type="text" name="movimentacao_inicial[0]" id="movimentacao_inicial[0]" class="form-control" datepicker-popup="dd/MM/yyyy" ng-model="relatorio.movimentacao[0].inicial" ng-required="true" show-button-bar="false" show-weeks="false" is-open="movimentacao[0].inicial.focus" ng-focus="movimentacao[0].inicial.focus = true" ng-change="movimentacao[0].final.focus = undefined" min-date="startDate" max-date="limitDate"/>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="movimentacao[0].inicial.focus = true"><i class="fa fa-calendar"></i></button>
                    </span>
                </p>
            </div>
            <label for="movimentacao_final[0]" class="col-lg-1 control-label text-center">a</label>
            <div class="col-lg-3">
                <p class="input-group">
                    <input type="text" name="movimentacao_final[0]" id="movimentacao_final[0]" class="form-control" datepicker-popup="dd/MM/yyyy" ng-model="relatorio.movimentacao[0].final" ng-required="true" show-button-bar="false" show-weeks="false" is-open="movimentacao[0].final.focus" ng-focus="movimentacao[0].final.focus = true" ng-change="movimentacao[0].final.focus = undefined" min-date="relatorio.movimentacao[0].inicial" max-date="limitDate" ng-disabled="!relatorio.movimentacao[0].inicial"/>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="movimentacao[0].final.focus = true"><i class="fa fa-calendar"></i></button>
                    </span>
                </p>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary" ng-disabled="ConsultarExtracoesForm.$invalid" ng-click="generate()">Gerar Relatório</button>
            </div>
        </div>
    </fieldset>
</form>
