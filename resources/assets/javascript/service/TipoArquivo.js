;(function (application) {
    'use strict';

    application.factory('TipoArquivo', function($resource) {
        return $resource('/api/tipo_arquivo/:id_tipo_arquivo', { id_tipo_arquivo: '@id_tipo_arquivo' }, {
            update: {
                method: 'PUT'
            },
            delete : {
                method: 'DELETE'
            }
        });
    });

})(application);
