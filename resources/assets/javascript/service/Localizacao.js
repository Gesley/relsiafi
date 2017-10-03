;(function (application) {
    'use strict';

    application.factory('Localizacao', function($resource) {
        return $resource('/api/localizacao/:id_localizacao', { id_localizacao: '@id_localizacao' });
    });

})(application);
