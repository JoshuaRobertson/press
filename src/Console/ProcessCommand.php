<?php

namespace JoshuaRobertson\press\Console;

use Illuminate\Console\Command;
use JoshuaRobertson\press\Facades\Press;
use JoshuaRobertson\press\Repositories\PostRepository;

class ProcessCommand extends Command
{
  protected $signature = 'press:process';

  protected $description = 'Update blog posts';

  public function handle(PostRepository $postRepository)
  {
    if (Press::configNotPublished()) {
      return $this->warn('Please publish the config file by running ' .
      '\'php artisan vendor:publish --tag=press-config\'');
    }

    try {
      // Fetch all posts
      $posts = Press::driver()->fetchPosts();

      $this->info('Number of posts: ' . count($posts));

      // Persist to the DB
      foreach ($posts as $post) {
        $postRepository->save($post);

        $this->info('Post: ' . $post['title']);
      }
    } catch (\Exception $e) {
      $this->error($e->getMessage());
    }
  }
}
