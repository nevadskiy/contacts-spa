<?php

namespace Tests;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class ApiTestCase extends TestCase
{
    use RefreshDatabase;

    protected function signIn(Authenticatable $user = null, $driver = 'api'): self
    {
        return $this->actingAs($user ?: factory(User::class)->create(), $driver);
    }
}
