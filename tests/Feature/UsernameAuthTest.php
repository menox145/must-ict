<?php

use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('registers a user without email and allows login with username', function () {
    $username = 'user' . Str::random(6);

    $response = $this->post('/register', [
        'name' => 'Test User',
        'username' => $username,
        'password' => 'secret123',
        'unit_bagian' => 'it',
    ]);

    $response->assertRedirect('/login');
    $this->assertDatabaseHas('users', [
        'username' => $username,
    ]);

    $response = $this->post('/login', [
        'username' => $username,
        'password' => 'secret123',
    ]);

    $response->assertRedirect();
    $this->assertAuthenticatedAs(User::where('username', $username)->first());
});

it('allows multiple registrations when email is not provided', function () {
    $firstUsername = 'user' . Str::random(6);
    $secondUsername = 'user' . Str::random(6);

    $first = $this->post('/register', [
        'name' => 'First User',
        'username' => $firstUsername,
        'password' => 'secret123',
        'unit_bagian' => 'it',
    ]);

    $second = $this->post('/register', [
        'name' => 'Second User',
        'username' => $secondUsername,
        'password' => 'secret123',
        'unit_bagian' => 'it',
    ]);

    $first->assertRedirect('/login');
    $second->assertRedirect('/login');
    $this->assertDatabaseHas('users', ['username' => $firstUsername]);
    $this->assertDatabaseHas('users', ['username' => $secondUsername]);
});
