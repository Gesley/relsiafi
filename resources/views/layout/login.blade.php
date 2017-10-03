<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" name="LoginForm" id="LoginForm">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="usuario">Usuário</label>
                            <div class="col-md-6">
                            <input type="text" required class="form-control" name="usuario" value="{{ old('login') }}" ng-model="autenticacao.usuario">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="senha">Senha</label>
                            <div class="col-md-6">
                                <input type="password" required class="form-control" name="senha" ng-model="autenticacao.senha" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" ng-disabled="LoginForm.$invalid" ng-click="executar()">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
