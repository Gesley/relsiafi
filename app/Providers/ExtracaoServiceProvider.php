<?php namespace RELSIAFI\Providers;

use Illuminate\Support\ServiceProvider;
use \RELSIAFI\Models\Extracao as ExtracaoModel;
use \RELSIAFI\Models\Observers\Extracao as ExtracaoObserver;

class ExtracaoServiceProvider extends ServiceProvider {

    public function boot()
    {
        ExtracaoModel::observe(new ExtracaoObserver);
    }
    public function register()
    {
        //
    }
}
