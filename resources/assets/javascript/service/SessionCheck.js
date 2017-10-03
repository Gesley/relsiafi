;(function (application) {
    'use strict';

    application.factory('SessionCheck', function ($q, $location, FlashFactory) {

        var responseError = function(response) {
            if(response.status === 401){
                FlashFactory.trigger({
                    'type': 'danger',
                    'message' : 'Por favor, efetue o login.'
                });
                $location.path('/');
            }

            return $q.reject(response);
        };

        return {
            responseError : responseError
        };
    });

})(application);
