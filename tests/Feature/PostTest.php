<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\BlogPost;

class PostTest extends TestCase
{

    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts yet!');
    }

    public function testSee1BlogPostWhenThereIs1WithNoComments()
    {
        // Arrange
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('New title');
        $response->assertSeeText('No Comments yet!');

        $this->assertDatabaseHas('blog_posts', [
          'title' => 'New title'
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        $post = $this->createDummyBlogPost();

        factory(Comment::class, 4)->create([
          'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');
    }

    public function testStoreValid()
    {
        $params = [
          'title' => 'Valid title',
          'content' => 'At least 10 characters'
        ];

        $this->post('/posts', $params)->assertStatus(302)->assertSessionHas('status'); // 302 - successive redirect

        $this->assertEquals(session('status'), 'Blog post was created successfully');
    }

    public function testStoreFail()
    {
        $params = [
          'title' => 'x',
          'content' => 'x'
        ];

        $this->post('/posts', $params)->assertStatus(302)->assertSessionHas('errors')->getMessages();

        $messages = session('errors');

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters');
        $this->assertEquals($messages['content'][0], 'The title must be at least 10 characters');
    }

    public function testUpdateValid()
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $params = [
          'title' => 'A new named title',
          'content' => 'Content was changed'
        ];

        $this->put('/posts/{$post->id}', $params)->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated');

        $this->assertDatabaseMissing('blog_posts', $post->toArray()); // Can't find original blog post before it was updated

        $this->assertDatabaseHas('blog_posts', [
          'title' => 'A new named title'
        ]);
    }

    public function testDelete()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->delete('/posts/{$post->id}')->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post deleted successfully');

        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    private function createDummyBlogPost(): BlogPost
    {
        //$post = new BlogPost();
        //$post->title = 'New title';
        //$post->content = 'Content of the blog post';
        //$post->save();

        return factory(BlogPost::class)->states('new-title');

        //return $post;
    }
}
