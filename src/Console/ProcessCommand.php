<?php

namespace JoshuaRobertson\press\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use JoshuaRobertson\press\PressFileParser;
use JoshuaRobertson\press\Press;
use JoshuaRobertson\press\Post;

class ProcessCommand extends Command
{
  protected $signature = 'press:process';

  protected $description = 'Update blog posts';

  public function handle()
  {
    if (Press::configNotPublished()) {
      return $this->warn('Please publish the config file by running ' .
      '\'php artisan vendor:publish --tag=press-config\'');
    }

    // Fetch all posts
    $posts = Press::driver()->fetchPosts();

    // Persist to the DB
    foreach ($posts as $post) {
      Post::create([
        'identifier' => Str::random(),
        'slug' => Str::slug($post['title']),
        'title' => $post['title'],
        'body' => $post['body'],
        'extra' => $post['extra'] ?? '',
      ]);
    }
  }
}
