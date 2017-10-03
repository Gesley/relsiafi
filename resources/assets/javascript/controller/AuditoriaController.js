;(function (application) {
    'use strict';

    application
        .controller('IndexAuditoriaController', function($scope, $filter, TipoArquivo, Auditoria, ExecucaoStatus, FlashFactory) {

            $scope.startDate = new Date(2015, 8);
            $scope.limitDate = new Date();

            TipoArquivo.query(function(data) {
                $scope.tiposArquivo = data;
            });

            ExecucaoStatus.query(function(data) {
                $scope.execucao_status = data;
            });

            Auditoria.query(function(data) {
                $scope.auditorias = data;
            });
        });

})(application);
