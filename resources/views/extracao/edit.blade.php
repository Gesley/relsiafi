<form class="form-horizontal" name="EditExtracaoForm" novalidate>
    <fieldset>
        <legend>Atualizar Extração</legend>

        <div class="form-group">
            <label for="nm_extracao" class="col-lg-2 control-label">Nome</label>
            <div class="col-lg-10">
                <input class="form-control" ng-maxlength="8" name="nm_extracao" type="text" id="nm_extracao" ui-mask="A99999A*" ng-model="extracao.nm_extracao"  ng-required="true"/>
            </div>
        </div>
        <div class="form-group">
            <label for="ds_extracao" class="col-lg-2 control-label">Descrição</label>
            <div class="col-lg-10">
                <input class="form-control" maxlength="100" ng-maxlength="100" name="ds_extracao" type="text" id="ds_extracao" ng-model="extracao.ds_extracao"  ng-required="true"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="button" ng-click="cancelar()" class="btn btn-default">Cancelar</button>
                <button type="submit" class="btn btn-primary" ng-disabled="EditExtracaoForm.$invalid" ng-click="atualizar()">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>
