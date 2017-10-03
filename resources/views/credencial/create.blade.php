<form class="form-horizontal" name="CreateCredencialForm" novalidate>
    <fieldset>
        <legend>Adicionar Credencial</legend>
        <div class="form-group">
            <label for="nm_usuario" class="col-lg-2 control-label">Usuário</label>
            <div class="col-lg-10">
                <select class="form-control" name="nm_username" id="nm_usuario" ng-model="credencial.nm_usuario" ng-change="onSelectedUserChange(option)" ng-required="true">
                        <option ng-repeat="option in ldapUsers | orderBy: 'name'" value="@{{option.username}}">@{{option.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="ds_email" class="col-lg-2 control-label">E-mail</label>
            <div class="col-lg-10">
                <input class="form-control" name="ds_email" type="email" id="ds_email" ng-model="credencial.ds_email"  ng-required="true"/>
            </div>
        </div>
        <div class="form-group bg-warning">
            <label for="nr_cpf" class="col-lg-2 control-label">CPF</label>
            <div class="col-lg-10">
                <input class="form-control" name="nr_cpf" type="text" id="nr_cpf" ng-model="credencial.nr_cpf" ui-mask="999.999.999-99"  ng-required="true"/>
                <span class="help-block">CPF utilizado para acesso ao STA</span>
            </div>
        </div>
        <div class="form-group bg-warning">
            <label for="ds_senha" class="col-lg-2 control-label">Senha</label>
            <div class="col-lg-10">
                <input class="form-control" name="ds_senha" type="password" id="ds_senha" ng-model="credencial.ds_senha"  ng-required="true" />
                <span class="help-block">Senha utilizada para acesso ao STA</span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="button" ng-click="cancelar()" class="btn btn-default">Cancelar</button>
                <button type="submit" class="btn btn-primary" ng-disabled="CreateCredencialForm.$invalid" ng-click="create()">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>
