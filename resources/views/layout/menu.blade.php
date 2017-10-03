<div class="collapse navbar-collapse" collapse="navCollapsed" ng-if="autenticacao.usuario">
    <ul class="nav navbar-nav">
        <li><a ng-href="/#/relatorio"><i class="fa fa-home"></i> Página Inicial / Relatórios</a></li>
        <li><a ng-href="/#/credencial"><i class="fa fa-user"></i> Credencial</a></li>
        <li><a ng-href="/#/extracao"><i class="fa fa-archive"></i> Extrações</a></li>
        <li><a ng-href="/#/tipo_arquivo"><i class="fa fa-file"></i> Tipo de Arquivo</a></li>
        <li><a ng-href="/#/auditoria"><i class="fa fa-history"></i> Auditoria</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li></li>
        <li><a ng-href="/#/relatorio"><i class="fa fa-user"></i> @{{ autenticacao.usuario }}</a></li>
        <li style="padding-right:5px"><a ng-href="/#/logout"><i class="fa fa-times-circle"></i> Sair</a></li>
    </ul>
</div>
