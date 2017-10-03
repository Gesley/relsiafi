<?php namespace RELSIAFI\Providers;

use Illuminate\Support\ServiceProvider;
use \RELSIAFI\Models\Credencial as CredencialModel;
use \RELSIAFI\Models\Observers\Credencial as CredencialObserver;

class CredencialServiceProvider extends ServiceProvider {

    public function boot()
    {
        CredencialModel::observe(new CredencialObserver);
    }
    public function register()
    {
        //
    }
}
