;(function (application) {
    'use strict';

    application
        .controller('IndexCredencialController', function($scope, $location, Credencial, FlashFactory, ModalFactory) {

            $scope.updateCredenciais = function() {
                Credencial.query(function(data) {
                    $scope.credenciais = data;
                });
            };

            $scope.updateCredenciais();

            $scope.activate = function(credencial) {
                var thereIsOneActivated = false;

                $scope.updateRemotely = function() {
                    var remoteCredencial = Credencial.get({}, {id_credencial : credencial.id_credencial});
                        remoteCredencial.st_ativo = 'A';
                        remoteCredencial.$update().then(function(response){
                            $scope.updateCredenciais();
                            FlashFactory.trigger(response);
                        });
                };

                angular.forEach($scope.credenciais, function(valor) {
                    if(valor.st_ativo === "A") {
                        thereIsOneActivated = true;
                    }
                });

                if(thereIsOneActivated) {
                    var options = {
                        title : 'Ativar credencial?',
                        size : 'sm',
                        type: 'confirmation',
                        question : 'Ativar a credencial desativará a credencial usada atualmente. Deseja realmente proceder com a operação?'
                    };

                    ModalFactory.trigger(options).result.then(function() {
                        $scope.updateRemotely();
                    });
                } else {
                    $scope.updateRemotely();
                }
            };

            $scope.edit = function(credencial) {
                $location.path('/credencial/edit/' + credencial.id_credencial);
            };

            $scope.delete = function(credencial) {
                if(credencial.st_ativo === 'A') {
                    FlashFactory.trigger({
                        'type' : 'error',
                        'message' : 'Não é possível remover uma credencial ativa!'
                    });
                } else {
                    var options = {
                        title : 'Remover credencial?',
                        size : 'sm',
                        type: 'confirmation',
                        question : 'Deseja realmente remover esta credencial?'
                    };

                    ModalFactory.trigger(options).result.then(function() {
                    var remoteCredencial = Credencial.get({}, {id_credencial : credencial.id_credencial});
                        remoteCredencial.st_deletado = 'S';
                        remoteCredencial.$remove().then(function(response){
                            $scope.updateCredenciais();
                            FlashFactory.trigger(response);
                        });
                    });
                }
            };
        })
        .controller('CreateCredencialController', function($scope, $location,Credencial, LDAP, FlashFactory) {
            LDAP.query(function(data) {
                $scope.ldapUsers = data;
            });

            $scope.onSelectedUserChange = function() {
                $scope.selectedUser = $scope.credencial.nm_usuario;

                angular.forEach($scope.ldapUsers, function(valor) {
                    if(valor.username === $scope.selectedUser) {
                        $scope.credencial.ds_email = valor.email;
                        $scope.credencial.ds_nome = valor.name;
                    }
                });

                $scope.credencial.nr_cpf = null;
                $scope.credencial.ds_senha = null;
            }

            $scope.create = function() {
                Credencial.save($scope.credencial).$promise.then(function(response){
                    FlashFactory.trigger(response);
                }, function(response){
                    FlashFactory.trigger(response);
                });
            };

            $scope.cancelar = function(extracao) {
                $location.path('/credencial');
            };
        })
        .controller('EditCredencialController', function($scope, $location,$routeParams, Credencial, FlashFactory) {
            var idCredencial = $routeParams.id;

            Credencial.get({id_credencial: idCredencial}, function(credencial) {
                $scope.credencial = credencial;
                $scope.credencial.nr_cpf = null;
                $scope.credencial.ds_senha = null;
            });

            $scope.atualizar = function() {
                var toUpdate = {};

                if($scope.EditCredencialForm.$dirty) {
                        var remoteCredencial = Credencial.get({}, {id_credencial : idCredencial});

                        angular.forEach(['ds_email', 'nr_cpf', 'ds_senha'], function(campo) {
                            if($scope.EditCredencialForm[campo].$dirty) {
                                remoteCredencial[campo] = $scope.credencial[campo];
                            }
                        });

                        remoteCredencial.$update().then(function(response){
                            FlashFactory.trigger(response);
                        });

                } else {
                    FlashFactory.trigger({
                        'type' : 'info',
                        'message' : 'Antes de atualizar é necessário que o formulário seja preenchido'
                    });
                }
            };

            $scope.cancelar = function(extracao) {
                $location.path('/credencial');
            };
        });

})(application);
