;(function (application) {
    'use strict';

    application
        .controller('IndexTipoArquivoController', function($scope, $location, TipoArquivo, Localizacao, FlashFactory, ModalFactory) {

            Localizacao.query(function(data) {
                $scope.localizacoes = data;
            });

            $scope.updateTipoArquivos = function() {
                TipoArquivo.query(function(data) {
                    $scope.tiposArquivo = data;
                });
            };

            $scope.edit = function(tipoArquivo) {
                $location.path('/tipo_arquivo/edit/' + tipoArquivo.id_tipo_arquivo);
            };

            $scope.delete = function(tipoArquivo) {
                var options = {
                    title : 'Remover Tipo de Arquivo?',
                    type: 'confirmation',
                    size: 'sm',
                    question : 'Deseja realmente remover este Tipo de Arquivo?'
                };

                ModalFactory.trigger(options).result.then(function() {
                    var remoteTipoArquivo = TipoArquivo.get({}, {id_tipo_arquivo : tipoArquivo.id_tipo_arquivo});
                    remoteTipoArquivo.$remove().then(function(response){
                        $scope.updateTipoArquivos();
                        FlashFactory.trigger(response);
                    });
                });
            };

            $scope.updateTipoArquivos();
        })
        .controller('CreateTipoArquivoController', function($scope, $location, $http, Localizacao, Extracao, TipoArquivo, FlashFactory, ModalFactory) {
            $scope.tipoArquivo = {};

            Localizacao.query(function(data) {
                $scope.localizacoes = data;
            });

            Extracao.query(function(data) {
                $scope.extracoes = data;
            });

            $scope.create = function(tipoArquivo) {
                TipoArquivo.save($scope.tipoArquivo).$promise.then(function(response){
                    FlashFactory.trigger(response);
                }, function(response){
                    FlashFactory.trigger(response);
                });
            };

            $scope.cancelar = function() {
                $location.path('/tipo_arquivo');
            };

            $scope.regexHelp = function() {
                $http.get('/tipo_arquivo/regex-help').then(function(response) {
                    ModalFactory.trigger({
                        title : 'Ajuda',
                        type: 'content',
                        size: 'lg',
                        content : response.data
                    });
                });
            }
        })
        .controller('EditTipoArquivoController', function($scope, $location, $http, $routeParams, TipoArquivo, Localizacao, Extracao, FlashFactory, ModalFactory) {
            var idTipoArquivo = $routeParams.id;

            TipoArquivo.get({id_tipo_arquivo : idTipoArquivo}, function(tipoArquivo) {
                $scope.tipoArquivo = tipoArquivo;
            });

            Localizacao.query(function(data) {
                $scope.localizacoes = data;
            });

            Extracao.query(function(data) {
                $scope.extracoes = data;
            });

            $scope.update = function() {
                var tipoArquivo = TipoArquivo.get({id_tipo_arquivo : $scope.tipoArquivo.id_tipo_arquivo}, function() {
                    tipoArquivo.id_extracao = $scope.tipoArquivo.id_extracao;
                    tipoArquivo.id_localizacao = $scope.tipoArquivo.id_localizacao;
                    tipoArquivo.sg_tipo_arquivo = $scope.tipoArquivo.sg_tipo_arquivo;
                    tipoArquivo.nm_tipo_arquivo = $scope.tipoArquivo.nm_tipo_arquivo;
                    tipoArquivo.ds_expressao_regular = $scope.tipoArquivo.ds_expressao_regular;

                    tipoArquivo.$update().then(function(response){
                        FlashFactory.trigger(response);
                    });
                });
            };

            $scope.regexHelp = function() {
                $http.get('/tipo_arquivo/regex-help').then(function(response) {
                    ModalFactory.trigger({
                        title : 'Ajuda',
                        type: 'content',
                        size: 'lg',
                        content : response.data
                    });
                });
            }

            $scope.cancelar = function() {
                $location.path('/tipo_arquivo');
            };
        });


})(application);
