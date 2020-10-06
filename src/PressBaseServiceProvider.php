<?php

namespace JoshuaRobertson\press;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use JoshuaRobertson\press\Facades\Press;

class PressBaseServiceProvider extends ServiceProvider
{
  public function boot()
  {
    if ($this->app->runningInConsole()) {
      $this->registerPublishing();
    }

    $this->registerResources();
  }

  public function register()
  {
    $this->commands([
      Console\ProcessCommand::class,
    ]);
  }

  private function registerResources()
  {
    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'press');

    $this->registerFacades();
    $this->registerRoutes();
    $this->registerFields();
  }

  protected function registerPublishing()
  {
    $this->publishes([
      __DIR__.'/../config/press.php' => config_path('press.php'),
    ], 'press-config');
  }

  protected function registerRoutes()
  {
    Route::group($this->routeConfiguration(), function () {
      $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    });
  }

  private function routeConfiguration()
  {
    return [
      'prefix' => Press::path(),
      'namespace' => 'JoshuaRobertson\press\Http\Controllers',
    ];
  }

  protected function registerFacades()
  {
    $this->app->singleton('Press', function ($app) {
      return new \JoshuaRobertson\press\Press();
    });
  }

  private function registerFields()
  {
    Press::fields([
      Fields\Body::class,
      Fields\Date::class,
      Fields\Description::class,
      Fields\Extra::class,
      Fields\Title::class,
    ]);
  }
}
