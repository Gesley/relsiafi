;(function (application) {
    'use strict';

    application
        .controller('LoginController', function($scope, $location, $rootScope, Autenticacao) {

            $scope.executar = function() {
                Autenticacao.login($scope.autenticacao);
            };

        })
        .controller('LogoutController', function(Autenticacao) {
                Autenticacao.logout();
        })

})(application);
