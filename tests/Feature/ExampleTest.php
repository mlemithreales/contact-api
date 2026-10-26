<?php

it('returns a successful health response', function () {
    $response = $this->getJson('/api/v1/health');

    $response->assertOk()
        ->assertJson([
            'status' => 'ok',
            'message' => 'API funcionando correctamente',
        ]);
});
