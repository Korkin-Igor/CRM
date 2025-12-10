<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['новый', 'в работе', 'обработан'];
        foreach ($statuses as $status) {
            Status::create(['name' => $status]);
        }
    }
}
