;(function (application) {
    'use strict';

    application.config(function($routeProvider, $locationProvider, $httpProvider) {

            $httpProvider.interceptors.push('SessionCheck');

            $routeProvider
                // Credencial
                .when('/credencial', {
                    templateUrl: 'credencial',
                    controller: 'IndexCredencialController'
                })
                .when('/credencial/create', {
                    templateUrl: 'credencial/create',
                    controller: 'CreateCredencialController'
                })
                .when('/credencial/edit/:id', {
                    templateUrl: 'credencial/edit',
                    controller: 'EditCredencialController'
                })
                // Extração
                .when('/extracao', {
                    templateUrl: 'extracao',
                    controller: 'IndexExtracaoController'
                })
                .when('/extracao/create', {
                    templateUrl: 'extracao/create',
                    controller: 'CreateExtracaoController'
                })
                .when('/extracao/edit/:id', {
                    templateUrl: 'extracao/edit',
                    controller: 'EditExtracaoController'
                })
                // Tipo de Arquivo
                .when('/tipo_arquivo', {
                    templateUrl: 'tipo_arquivo',
                    controller: 'IndexTipoArquivoController'
                })
                .when('/tipo_arquivo/create', {
                    templateUrl: 'tipo_arquivo/create',
                    controller: 'CreateTipoArquivoController'
                })
                .when('/tipo_arquivo/edit/:id', {
                    templateUrl: 'tipo_arquivo/edit',
                    controller: 'EditTipoArquivoController'
                })
                // Auditoria
                .when('/auditoria', {
                    templateUrl: 'auditoria',
                    controller: 'IndexAuditoriaController'
                })
                // Relatorio
                .when('/relatorio', {
                    templateUrl: 'relatorio',
                    controller: 'IndexRelatorioController'
                })
                // Login
                .when('/login', {
                    templateUrl: 'layout/login',
                    controller: 'LoginController'
                })
                .when('/logout', {
                    templateUrl: 'layout/login',
                    controller: 'LogoutController'
                })
                .otherwise({
                    redirectTo: '/login'
                });

            $locationProvider.hashPrefix('');
        }
    );
})(application);
