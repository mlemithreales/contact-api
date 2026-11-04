<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('un usuario puede iniciar sesión', function () {
    $user = User::factory()->create([
        'password' => 'Password123',
    ]);

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'Password123',
        'device_name' => 'Dispositivo de prueba',
    ]);

    $response->assertOk()
        ->assertJsonStructure([
            'token',
            'token_type',
            'user' => ['id', 'name', 'email'],
        ]);
});

test('no permite iniciar sesión con credenciales incorrectas', function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'incorrecta',
        'device_name' => 'Dispositivo de prueba',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors('email');
});

test('un usuario autenticado puede consultar su perfil', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/v1/auth/me');

    $response->assertOk()
        ->assertJsonPath('data.id', $user->id)
        ->assertJsonPath('data.email', $user->email);
});

test('un usuario autenticado puede cerrar sesión', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/v1/auth/logout');

    $response->assertNoContent();
});

test('no permite consultar el perfil sin autenticación', function () {
    $response = $this->getJson('/api/v1/auth/me');

    $response->assertUnauthorized();
});