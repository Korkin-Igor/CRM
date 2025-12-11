<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'link',
        'ticket_id'
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function getUrl(): string
    {
        return asset('storage/' . trim($this->link, '/'));
    }

    public function getHumanReadableSize(): string
    {
        $path = storage_path('app/public/' . $this->link);
        if (!file_exists($path)) {
            return 'N/A';
        }
        $size = filesize($path);
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        return round($size, 2) . ' ' . $units[$i];
    }
}
