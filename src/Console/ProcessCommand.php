<?php

namespace JoshuaRobertson\press\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use JoshuaRobertson\press\Facades\Press;
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

    try {
      // Fetch all posts
      $posts = Press::driver()->fetchPosts();

      // Persist to the DB
      foreach ($posts as $post) {
        Post::create([
          'identifier' => $post['identifier'],
          'slug' => Str::slug($post['title']),
          'title' => $post['title'],
          'body' => $post['body'],
          'extra' => $post['extra'] ?? '',
        ]);
      }
    } catch (\Exception $e) {
      $this->error($e->getMessage());
    }
  }
}
