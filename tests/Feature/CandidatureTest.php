<?php

use App\Models\Candidature;
use App\Models\User;

// ─── Unauthenticated access ──────────────────────────────────────────────────

test('guest is redirected from candidatures page', function () {
    $this->get(route('candidatures.index'))
        ->assertRedirect(route('login'));
});

test('guest is redirected from candidature store', function () {
    $this->post(route('candidatures.store'), [])
        ->assertRedirect(route('login'));
});

// ─── Authorization (Policy) ──────────────────────────────────────────────────

test('user cannot view another users candidature', function () {
    $candidature = Candidature::factory()->create();
    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)
        ->get(route('candidatures.show', $candidature))
        ->assertForbidden();
});

test('user cannot edit another users candidature', function () {
    $candidature = Candidature::factory()->create();
    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)
        ->get(route('candidatures.edit', $candidature))
        ->assertForbidden();
});

test('user cannot update another users candidature', function () {
    $candidature = Candidature::factory()->create();
    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)
        ->put(route('candidatures.update', $candidature), [
            'company_name' => 'Hacked',
            'role' => 'Hacker',
            'status' => 'applied',
            'priority' => 'high',
            'application_date' => '2026-05-20',
        ])
        ->assertForbidden();
});

test('user cannot archive another users candidature', function () {
    $candidature = Candidature::factory()->create();
    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)
        ->delete(route('candidatures.archive', $candidature))
        ->assertForbidden();
});

// ─── Create candidature ──────────────────────────────────────────────────────

test('valid candidature creation stores record and redirects', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('candidatures.store'), [
            'company_name' => 'Acme Corp',
            'role' => 'Laravel Developer',
            'status' => 'applied',
            'priority' => 'high',
            'application_date' => '2026-05-20',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('candidatures', [
        'company_name' => 'Acme Corp',
        'role' => 'Laravel Developer',
        'user_id' => $user->id,
    ]);
});

test('invalid candidature creation returns validation errors', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('candidatures.store'), [])
        ->assertSessionHasErrors([
            'company_name', 'role', 'status', 'priority', 'application_date',
        ]);
});

// ─── Archive / Restore ───────────────────────────────────────────────────────

test('archiving a candidature sets deleted_at', function () {
    $user = User::factory()->create();
    $candidature = Candidature::factory()->for($user)->create();

    $this->actingAs($user)
        ->delete(route('candidatures.archive', $candidature))
        ->assertRedirect(route('candidatures.index'));

    expect($candidature->fresh()->deleted_at)->not->toBeNull();
});

test('restoring a candidature clears deleted_at', function () {
    $user = User::factory()->create();
    $candidature = Candidature::factory()->for($user)->create(['deleted_at' => now()]);

    $this->actingAs($user)
        ->post(route('candidatures.restore', $candidature))
        ->assertRedirect(route('candidatures.show', $candidature));

    expect($candidature->fresh()->deleted_at)->toBeNull();
});
