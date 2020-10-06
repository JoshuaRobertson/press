<?php

namespace JoshuaRobertson\Press;

use Illuminate\Support\Str;

class Press
{
  public static function configNotPublished()
  {
    return is_null(config('press'));
  }

  public static function driver()
  {
    $driver = Str::title(config('press.driver'));
    $class = 'JoshuaRobertson\press\Drivers\\' . $driver . 'Driver';

    return new $class;
  }

  public static function path()
  {
    return config('press.path', 'blogs');
  }
}
