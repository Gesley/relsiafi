;(function (application) {
    'use strict';

    application.factory('Extracao', function($resource) {
        return $resource('/api/extracao/:id_extracao', { id_extracao: '@id_extracao' }, {
            update: {
                method: 'PUT'
            },
            delete : {
                method: 'DELETE'
            }
        });
    });

})(application);
