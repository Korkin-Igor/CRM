<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        $customer = Customer::factory()->create();
        $status = Status::inRandomOrder()->first();
        return [
            'customer_id' => $customer->id,
            'theme' => $this->faker->sentence(),
            'text' => $this->faker->text(),
            'status_id' => $status->id,
            'response_date' => rand(0,1) ? $this->faker->date() : null,
        ];
    }
}
