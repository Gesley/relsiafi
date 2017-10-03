<form name="ConsultarTipoArquivoForm" id="ConsultarTipoArquivoForm">
    <fieldset>
        <legend>Consultar Tipo de Arquivo</legend>
        <div class="row-fluid">
            <div class="col-md-5">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Consultar por Sigla ou Tipo Arquivo" ng-model="searchTipoArquivo" />
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <div class="input-group">
                        <select class="form-control" name="nm_localizacao" id="nm_localizacao" ng-model="localizacao">
                            <option selected="selected" value="">Localização</option>
                            <option ng-repeat="localizacao in localizacoes | orderBy: 'nm_localizacao'" value="@{{localizacao.id_localizacao}}">@{{localizacao.nm_localizacao}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary" ng-href="/#/tipo_arquivo/create"><i class="fa fa-plus-circle"></i> Criar Tipo Arquivo</a>
            </div>
        </div>
    </fieldset>
</form>
<hr />
    <table class="table table-striped tipos-de-arquivos">
        <thead>
            <th>Tipo de Arquivo</th>
            <th>Localização</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <tr ng-repeat="tipoArquivo in filtro = (tiposArquivo | orderBy: 'nm_tipo_arquivo' | filter:{id_localizacao : localizacao} | filter: searchTipoArquivo)">
                <td>@{{tipoArquivo.sg_tipo_arquivo}} - @{{tipoArquivo.nm_tipo_arquivo}}</td>
                <td>@{{tipoArquivo.localizacao.nm_localizacao}}</td>
                <td>
                    <ul class="list-inline actions">
                        <li><button class="btn btn-xs" ng-click="edit(tipoArquivo)" tooltip="Editar"><i class="fa fa-pencil-square-o"></i></button></li>
                        <li><button class="btn btn-xs" ng-click="delete(tipoArquivo)" tooltip="Excluir"><i class="fa fa-times-circle"></i></button></li>
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
            <th>Tipo de Arquivo</th>
            <th>Localização</th>
            <th>Ações</th>
        </tfoot>
    </table>

    <div class="row-fluid">
        <div class="col-md-2 col-md-offset-10">
            Nº de Registros: @{{ filtro.length }}
        </div>
    </div>
</div>
