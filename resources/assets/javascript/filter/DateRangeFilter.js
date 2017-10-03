;(function (application) {
    'use strict';

    application.filter('dateRange', function($filter) {
        return function(input, property, startDate, endDate) {
            var output = [];

            angular.forEach(input, function(objeto) {
                if (objeto[property] === null) return false;

                var itemDate = new Date(objeto[property]);
                    itemDate.setHours(0);
                    itemDate.setMinutes(0);
                    itemDate.setSeconds(0);


                if(angular.isUndefined(startDate) && angular.isUndefined(endDate)) {
                    output.push(objeto);
                } else if(angular.isDefined(startDate) && angular.isUndefined(endDate)) {
                    startDate = new Date(startDate).getTime();

                    if(itemDate >= startDate) output.push(objeto);
                } else {
                    startDate = new Date(startDate).getTime();
                    endDate = new Date(endDate).getTime();

                    if(itemDate >= startDate && itemDate <= endDate) output.push(objeto);
                }
            });

            return output;
        };
    });

})(application);
