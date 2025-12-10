<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public static function getStatusIdByName(string $name): int
    {
        return Status::where('name', $name)->value('id');
    }
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
