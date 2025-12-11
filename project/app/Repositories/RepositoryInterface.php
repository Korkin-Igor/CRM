<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function getFilteredTickets(?array $filters, ?int $perPage = 15);
    public function show(int $id);
    public function create(array $data);
    public function update(int $id, array $data): bool;
}
