<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_create()
    {
        $user = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        $response = $this->post('/api/user', $user);

        $response->assertStatus(200)
            ->assertJson([
                'Code' => 200,
                'Msg' => 'Success'
            ]);
    }

    public function test_read()
    {
        $user = User::factory()->create();

        $response = $this->get("/api/user/$user->id");

        $response->assertStatus(200)
            ->assertJson([
                'Code'  => 200,
                'Msg'   => 'Success',
                'Data'  => [
                    "id"    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ]
            ]);
    }

    public function test_update()
    {
        $user = User::factory()->create();

        $response = $this->patch("/api/user/$user->id", [
            'name' => $this->faker->name(),
            'password' => '13'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'Code' => 200,
                'Msg' => 'Success'
            ]);

        $this->assertNotEquals($user->name, $response->json('name'));
    }

    public function test_delete()
    {
        $user = User::factory()->create();

        $response = $this->delete("/api/user/$user->id");

        $this->assertNotEquals($user->name, $response->json('name'));

        $response->assertStatus(200)
            ->assertJson([
                'Code' => 200,
                'Msg' => 'Success'
            ]);
    }
}
