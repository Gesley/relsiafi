<?php namespace RELSIAFI\Providers;

use Illuminate\Support\ServiceProvider;
use \RELSIAFI\Models\Auditoria as AuditoriaModel;
use \RELSIAFI\Models\Observers\Auditoria as AuditoriaObserver;

class AuditoriaServiceProvider extends ServiceProvider {

    public function boot()
    {
        AuditoriaModel::observe(new AuditoriaObserver);
    }
    public function register()
    {
        //
    }
}
