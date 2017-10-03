<form name="ConsultarExtracaoForm" id="ConsultarExtracaoForm">
    <fieldset>
        <legend>Consultar Extração</legend>
        <div class="row-fluid">
            <div class="col-md-10">
                <div class="form-group">
                    <div class="input-group ">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" class="form-control" placeholder="Consultar Extração" ng-model="searchExtracao" />
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary" ng-href="/#/extracao/create"><i class="fa fa-plus-circle"></i> Criar Extração</a>
            </div>
        </div>
    </fieldset>
</form>
<hr />
    <table class="table table-striped extracoes">
        <thead>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <tr ng-repeat="extracao in filtro = (extracoes | orderBy: 'nm_extracao' | filter: searchExtracao )">
                <td><span tooltip="@{{extracao.usuario}}">@{{extracao.sg_extracao}} (@{{extracao.nm_extracao}})</span></td>
                <td>@{{extracao.ds_extracao}}</td>
                <td>
                    <ul class="list-inline actions">
                        <li><button class="btn btn-xs" ng-click="edit(extracao)" tooltip="Editar"><i class="fa fa-pencil-square-o"></i></button></li>
                        <li><button class="btn btn-xs" ng-click="delete(extracao)" tooltip="Excluir"><i class="fa fa-times-circle"></i></button></li>
                    </ul>
                </td>
            </tr>
            <tr ng-if="filtro.length == 0">
                <td colspan="3" class="text-center">
                    Nenhum registro encontrado.
                </td>
            </tr>
        </tbody>
        <tfoot>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tfoot>
    </table>

    <div class="row-fluid">
        <div class="col-md-2 col-md-offset-10">
            Nº de Registros: @{{ filtro.length }}
        </div>
    </div>
