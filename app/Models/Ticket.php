<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->where('status');
        }

        return $query;
    }

    public function scopePriority($query, $priority)
    {
        if ($priority) {
            return $query->where('priority');
        }

        return $query;
    }
}
