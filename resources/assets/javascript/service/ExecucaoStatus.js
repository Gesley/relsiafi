;(function (application) {
    'use strict';

    application.factory('ExecucaoStatus', function($resource) {
        return $resource('/api/execucao_status');
    });

})(application);
