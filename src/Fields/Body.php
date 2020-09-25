<?php

namespace JoshuaRobertson\press\Fields;

use JoshuaRobertson\press\MarkdownParser;

class Body extends FieldContract
{
  public static function process($type, $value, $data)
  {
    return [
      $type => MarkdownParser::parse($value)
    ];
  }
}
