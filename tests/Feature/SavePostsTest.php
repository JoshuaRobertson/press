<?php

namespace JoshuaRobertson\press\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JoshuaRobertson\press\Post;

class SavePostsTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function a_post_can_be_created_with_the_factory()
  {
    $post = factory(Post::class)->create();

    $this->assertCount(1, Post::all());
  }
}
