<?php

namespace JoshuaRobertson\press\Fields;

use JoshuaRobertson\press\MarkdownParser;

class Body
{
  public static function process($type, $value)
  {
    return [
      $type => MarkdownParser::parse($value)
    ];
  }
}
