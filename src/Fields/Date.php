<?php

namespace JoshuaRobertson\press\Fields;

use Carbon\Carbon;

class Date
{
  public static function process($type, $value)
  {
    return [
      $type => Carbon::parse($value),
      'parsed_at' => Carbon::now()
    ];
  }
}
