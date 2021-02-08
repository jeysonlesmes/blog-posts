<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class PostModuleTest extends TestCase
{
    public function test_home_screen_can_be_rendered()
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_posts_screen_can_be_rendered()
    {
        $this->actingAs($this->getUser())
            ->get(route("posts.index"))
            ->assertStatus(200);
    }

    public function test_create_post_screen_can_be_rendered()
    {
        $this->actingAs($this->getUser())
            ->get(route("posts.create"))
            ->assertStatus(200);
    }

    public function test_dashboard_redirects_to_post_screen()
    {
        $this->actingAs($this->getUser())
            ->get(route("dashboard"))
            ->assertRedirect(route("posts.index"));
    }

    public function test_post_can_be_created()
    {
        $user = $this->getUser();

        $response = $this->actingAs($user)->post(route("posts.store"), [
            'title' => 'Omnis voluptas nihil omnis debitis.',
            'description' => 'Explicabo ut aut rem dolores assumenda quo vel doloremque aut. Sint consequatur quis ipsum reprehenderit aspernatur ut. Illo ut quia est minus soluta voluptatem temporibus ut. Unde itaque est et aperiam aliquid iste.',
            'publication_date' => date("Y-m-d H:i:s"),
            'user_id' => $user->id
        ]);
        
        $response->assertRedirect(route("posts.index"));
    }

    private function getUser(): User
    {
        return User::factory()->create();
    }
}
