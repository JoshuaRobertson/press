<?php

namespace JoshuaRobertson\press\Drivers;

use Illuminate\Support\Facades\File;
use JoshuaRobertson\press\PressFileParser;

class FileDriver
{
  public function fetchPosts()
  {
    $files = File::files(config('press.path'));

    foreach ($files as $file) {
      $posts[] = (new PressFileParser($file->getPathname()))->getData();
    }

    return $posts ?? [];
  }
}
