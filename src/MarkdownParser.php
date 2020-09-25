<?php

namespace JoshuaRobertson\press;

class MarkdownParser
{
  public static function parse($string)
  {
    return \Parsedown::instance()->text($string);
  }
}
