<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" ng-init="navCollapsed = true" ng-click="navCollapsed = !navCollapsed">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" ng-href="/#/relatorio">Sistema de Relatórios do SIAFI</a>
    </div>

    @include('layout/menu')
</nav>
