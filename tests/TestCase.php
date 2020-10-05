<?php

namespace JoshuaRobertson\press\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
  protected function getPackageProviders($app)
  {
    return [
      PressBaseServiceProvider::class,
    ];
  }
}
