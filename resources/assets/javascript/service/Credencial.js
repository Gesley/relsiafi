;(function (application) {
    'use strict';

    application.factory('Credencial', function($resource) {
        return $resource('/api/credencial/:id_credencial', { id_credencial: '@id_credencial' }, {
            update: {
                method: 'PUT'
            },
            delete : {
                method: 'DELETE'
            }
        });
    });

})(application);
