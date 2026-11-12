<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('crea un contacto válido', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->postJson('/api/v1/contacts', [
        'name' => 'Ana Torres',
        'phone_number' => '3001234567',
    ]);

    $response->assertCreated()
        ->assertJsonPath('data.name', 'Ana Torres')
        ->assertJsonPath('data.phone_number', '3001234567');

    $this->assertDatabaseHas('contacts', [
        'user_id' => $user->id,
        'name' => 'Ana Torres',
        'phone_number' => '3001234567',
        'email' => null,
    ]);
});

test('devuelve 404 para un contacto ajeno', function () {
    $owner = User::factory()->create();
    $visitor = User::factory()->create();
    $contact = Contact::factory()->for($owner)->create([
        'name' => 'Contacto privado',
    ]);
    Sanctum::actingAs($visitor);

        $this->getJson('/api/v1/contacts/'.$contact->id)
        ->assertNotFound()
        ->assertJsonMissing(['name' => 'Contacto privado']);

    $this->assertDatabaseHas('contacts', [
        'id' => $contact->id,
        'user_id' => $owner->id,
        'name' => 'Contacto privado',
    ]);
});

test('no crea un contacto sin teléfono', function () {
   
    $user = User::factory()->create();
    Sanctum::actingAs($user);

   
    $response = $this->postJson('/api/v1/contacts', [
        'name' => 'Ana Torres',
    ]);

   
    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['phone_number']);
    
    $this->assertDatabaseCount('contacts', 0);
});

