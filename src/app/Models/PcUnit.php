<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PcUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'artifact_id',
        'management_no',
        'status',
        'received_at',
        'warranty',
    ];

    protected function casts(): array
    {
        return [
            'received_at' => 'immutable_date',
            'warranty' => 'boolean',
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }

    public function artifact(): BelongsTo
    {
        return $this->belongsTo(Artifact::class);
    }
}
