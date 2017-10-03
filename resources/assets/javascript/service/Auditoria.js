;(function (application) {
    'use strict';

    application.factory('Auditoria', function($resource) {
        return $resource('/api/auditoria');
    });

})(application);
