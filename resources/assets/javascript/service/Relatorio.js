;(function (application) {
    'use strict';

    application.factory('Relatorio', function($locale, $http) {
        var startDate = function() {
            return new Date(2015, 8);
        },
        limitDate = function() {
            return new Date();
        },
        dateRange = function() {
            var months = $locale.DATETIME_FORMATS.MONTH,
                dateRange = [],
                startYear = startDate().getFullYear(),
                limitYear = limitDate().getFullYear();

            while(startYear <= limitYear) {
                angular.forEach(months, function(value, mesCorrente) {
                    value = value.charAt(0).toUpperCase() + value.slice(1);

                    if(startYear == startDate().getFullYear()) {
                        if(mesCorrente >= startDate().getMonth() && mesCorrente <= limitDate().getMonth()) {
                            dateRange.push({month : { number : mesCorrente + 1, desc : value }, year : startYear});
                        }
                    } else {
                        dateRange.push({month : { number : mesCorrente + 1, desc : value }, year : startYear});
                    }
                });

                startYear++;
            }

            return dateRange;
        },
        generate = function(options) {
            $http.post('/relatorio', options, {
                cache : false,
                responseType : 'arraybuffer'
            }).then(function(response) {
                if(options.id_formato == 1) {
                    var blobOption = {type: 'application/pdf'};
                } else if(options.id_formato == 2) {
                    var blobOption = {type: 'application/vnd.ms-excel'};
                }

                var blob = new Blob(["\ufeff", response.data], blobOption);
                var objectUrl = URL.createObjectURL(blob);

                window.open(objectUrl);
            });
        };

        return  {
            startDate : startDate,
            limitDate : limitDate,
            dateRange : dateRange,
            generate :  generate
        }
    });

})(application);
