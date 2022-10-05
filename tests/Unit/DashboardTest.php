<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DashboardTest extends TestCase
{

    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_auth_user_data(): void
    {

        $user = User::query()->first();

         $data = $this
             ->actingAs($user)
             ->get(route('get-auth-user-data'));
         $data->assertStatus(200);
    }


    public function test_get_auth_user_data_structure(): void
    {

        $user = User::query()->first();

        $data = $this
            ->actingAs($user)
            ->get(route('get-auth-user-data'));
        $data->assertJsonStructure([
                'user',
                'main',
        ]);
    }

    public function test_login_user(): void
    {

        User::create([
            'first_name' => 'test',
            'email' => 'test@test.com',
            'password'  => bcrypt('secret')
        ]);

        $this->withoutMiddleware();
        $data = $this
            ->post('/login', [
                'email' => 'test@test.com',
                'password' => 'secret'
            ]);
        $data->assertStatus(200);
    }

}
