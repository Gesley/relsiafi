;(function (application) {
    'use strict';

    application.factory('ModalFactory', function($modal) {

        var trigger = function(options) {

            if(angular.isString(options.type)) {
                switch(options.type) {
                    case 'confirmation' : options.template = '/layout/modal-with-confirmation'; break;
                    case 'content' : options.template = '/layout/modal-content'; break;
                }
            }

            var modalInstance = $modal.open({
                animation: true,
                controller: 'ModalInstanceController',
                templateUrl: options.template,
                size: options.size,
                resolve : {
                    options : function() {
                        return options;
                    }
                }
            });

            return modalInstance;
        };

        return  {
            trigger : trigger
        }
    });

})(application);
