<?php

namespace Tests\Feature;

use App\Models\Guide;
use App\Models\HuntingBooking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

public function test_booking_creation_fails_if_guide_busy(): void
{
    $guide = Guide::factory()->create();
    HuntingBooking::factory()->create([
        'guide_id' => $guide->id,
        'date' => now()->toDateString(),
    ]);

    $response = $this->postJson('/api/bookings', [
        'tour_name' => 'Wolf Hunt',
        'hunter_name' => 'Ilya',
        'guide_id' => $guide->id,
        'date' => now()->toDateString(),
        'participants_count' => 5,
    ]);

    $response->assertStatus(422)
        ->assertJson(['message' => 'Guide already has a booking on this date.']);
}
