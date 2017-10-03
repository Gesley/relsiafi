;(function (application) {
    'use strict';

    application
        .controller('IndexRelatorioController', function($scope, Relatorio) {
            $scope.startDate = Relatorio.startDate();
            $scope.limitDate = Relatorio.limitDate();
            $scope.dateRange = Relatorio.dateRange();

            $scope.formatos = [
                {id : 1, desc : 'PDF(Portable Document Format)'},
                {id : 2, desc : 'Planilha Eletrônica(Excel)'}
            ];

            $scope.relatorios = [
                {id : 1, desc : 'Relatório extração de dados SIAFI operacional'},
                {id : 2, desc : 'Relatório Prestação de Contas – Extração dos dados SIAFI Operacional'},
                {id : 3, desc : 'Relatório Consolidado das Extrações de dados SIAFI Operacional'},
                {id : 4, desc : 'Relatório da Extração de Carga Incremental – SIAFI Operacional'},
                {id : 5, desc : 'Relatório Demonstrativo de Faturamento – Ministério da Integração Nacional'}
            ];

            $scope.generate = function() {
                Relatorio.generate($scope.relatorio);
            };
        });


})(application);
