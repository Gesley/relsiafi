<?php

namespace RELSIAFI\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

use RELSIAFI\Models\ArquivoRecebido as ArquivoRecebidoModel;
use RELSIAFI\Models\Observers\ArquivoRecebido as ArquivoRecebidoObserver;

class TipoArquivoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       Validator::extend('regex_test', function($attribute, $value, $parameters) {
            $match = preg_match('@' . $value . '@', null);

            return ! preg_last_error();
        });

        ArquivoRecebidoModel::observe(new ArquivoRecebidoObserver);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
