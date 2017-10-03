;(function (application) {
    'use strict';

    application
        .controller('IndexExtracaoController', function($scope, $location, Extracao, FlashFactory, ModalFactory) {

            $scope.updateExtracoes = function() {
                Extracao.query(function(data) {
                    $scope.extracoes = data;
                });
            };

            $scope.updateExtracoes();

            $scope.edit = function(extracao) {
                $location.path('/extracao/edit/' + extracao.id_extracao);
            };

            $scope.delete = function(extracao) {
                var options = {
                    title : 'Remover extração?',
                    type: 'confirmation',
                    size: 'sm',
                    question : 'Deseja realmente remover esta extração?'
                };

                ModalFactory.trigger(options).result.then(function() {
                var remoteExtracao = Extracao.get({}, {id_extracao : extracao.id_extracao});
                    remoteExtracao.st_ativo = 'I';
                    remoteExtracao.$remove().then(function(response){
                        $scope.updateExtracoes();
                        FlashFactory.trigger(response);
                    });
                });
            };
        })
        .controller('CreateExtracaoController', function($scope, $location, Extracao, FlashFactory) {

            $scope.extracao = {};

            $scope.create = function() {

                $scope.extracao.sg_extracao = $scope.extracao.nm_extracao.substring(6,8);

                Extracao.save($scope.extracao).$promise.then(function(response){
                    FlashFactory.trigger(response);
                }, function(response){
                    FlashFactory.trigger(response);
                });

            };

            $scope.cancelar = function(extracao) {
                $location.path('/extracao');
            };
        })
        .controller('EditExtracaoController', function($scope, $location, $routeParams, Extracao, FlashFactory) {
            var idExtracao = $routeParams.id;

            Extracao.get({id_extracao : idExtracao}, function(extracao) {
                $scope.extracao = extracao;
            });

            $scope.atualizar = function() {

                $scope.extracao.sg_extracao = $scope.extracao.nm_extracao.substring(6,8);

                var remoteExtracao = Extracao.get({}, {id_extracao : $scope.extracao.id_extracao});

                    remoteExtracao.sg_extracao = $scope.extracao.sg_extracao;
                    remoteExtracao.nm_extracao = $scope.extracao.nm_extracao;
                    remoteExtracao.ds_extracao = $scope.extracao.ds_extracao;
                    remoteExtracao.st_ativo = $scope.extracao.st_ativo;

                    remoteExtracao.$update().then(function(response){
                        FlashFactory.trigger(response);
                    }, function(response) {
                    FlashFactory.trigger({
                        'type' : 'info',
                        'message' : 'Antes de atualizar é necessário que o formulário seja preenchido'
                    });
                });

            };

            $scope.cancelar = function(extracao) {
                $location.path('/extracao');
            };
        });


})(application);
