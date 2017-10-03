;(function (application) {
    'use strict';

    application.factory('Autenticacao', function($http, $location, $rootScope, $cookies, FlashFactory) {

        var login = function(credentials) {
            $http.post('/login', credentials).then(function(response) {
                if(response.data.type === 'success') {
                    FlashFactory.trigger(response.data);
                    $location.path('relatorio');
                } else {
                    FlashFactory.trigger(response.data);
                }
            });
        },
        logout = function() {
            return $http.get('/login/logout').then(function(response) {
                FlashFactory.trigger(response.data);
                delete $rootScope.autenticacao;
            });
        },
        getAutorizacao  = function() {
            return $http.get('/login/autenticacao');
        };

        return {
            login: login,
            logout: logout,
            getAutorizacao : getAutorizacao
        };
    });

})(application);
