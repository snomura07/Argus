<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'assignee_type',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }

    public function lendings(): HasMany
    {
        return $this->hasMany(Lending::class);
    }
}
