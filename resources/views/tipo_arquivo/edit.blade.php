<form class="form-horizontal" name="EditTipoArquivoForm">
    <fieldset>
        <legend>Atualizar Tipo de Arquivo</legend>

        <div class="form-group">
            <label for="id_extracao" class="col-lg-2 control-label">Extração</label>
            <div class="col-lg-10">
                <select class="form-control" name="id_extracao" id="nm_usuario" ng-model="tipoArquivo.id_extracao" ng-required="true">
                        <option ng-repeat="extracao in extracoes | orderBy: 'nm_extracao'" value="@{{extracao.id_extracao}}">@{{extracao.nm_extracao}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="id_localizacao" class="col-lg-2 control-label">Localização</label>
            <div class="col-lg-10">
                <select class="form-control" name="id_localizacao" id="id_localizacao" ng-model="tipoArquivo.id_localizacao" ng-required="true" popover="Alterar esta localização poderá fazer com que o tipo de arquivo associado não seja capturado pela ferramenta!"  popover-trigger="focus">
                        <option ng-repeat="localizacao in localizacoes | orderBy: 'nm_localizacao'" value="@{{localizacao.id_localizacao}}">@{{localizacao.nm_localizacao}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="sg_tipo_arquivo" class="col-lg-2 control-label">Sigla</label>
            <div class="col-lg-10">
                <input class="form-control" ng-maxlength="8" name="sg_tipo_arquivo" type="text" id="sg_tipo_arquivo" ng-model="tipoArquivo.sg_tipo_arquivo" ui-mask="AA?A?A?A" ng-required="true"/>
            </div>
        </div>
        <div class="form-group">
            <label for="nm_tipo_arquivo" class="col-lg-2 control-label">Tipo de Arquivo</label>
            <div class="col-lg-10">
                <input class="form-control" ng-maxlength="50"  maxlength="50" name="nm_tipo_arquivo" type="text" id="nm_tipo_arquivo" ng-model="tipoArquivo.nm_tipo_arquivo" ng-required="true"/>
            </div>
        </div>
        <div class="form-group">
            <label for="ds_expressao_regular" class="col-lg-2 control-label">Expressão Regular</label>
            <div class="col-lg-9">
                <textarea class="form-control" ng-maxlength="70" maxlength="70" name="ds_expressao_regular" type="text" id="ds_expressao_regular" ng-model="tipoArquivo.ds_expressao_regular" style="resize: none" ng-required="true" popover-template="@{{$scope.popoverTemplate}}" popover-trigger="focus"/>
                </textarea>
            </div>
            <div class="col-lg-1">
                <button type="button" class="btn btn-info btn-lg" ng-click="regexHelp()"><i class="fa fa-question"></i></button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="button" ng-click="cancelar()" class="btn btn-default">Cancelar</button>
                <button type="submit" class="btn btn-primary" ng-disabled="!EditTipoArquivoForm.$dirty" ng-click="update()">Atualizar</button>
            </div>
        </div>
    </fieldset>
</form>
