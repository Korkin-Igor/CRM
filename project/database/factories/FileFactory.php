<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    public function definition(): array
    {
        $ticket = Ticket::factory()->create();
        return [
            'link' => $this->faker->url(),
            'ticket_id' => $ticket->id,
        ];
    }
}
