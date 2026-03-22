<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtifactStock extends Model
{
    use HasFactory;

    protected $table = 'artifact_stock';

    protected $primaryKey = 'artifact_id';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'artifact_id',
        'opened_count',
        'unopened_count',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'artifact_id' => 'integer',
            'opened_count' => 'integer',
            'unopened_count' => 'integer',
            'updated_at' => 'immutable_datetime',
        ];
    }

    public function artifact(): BelongsTo
    {
        return $this->belongsTo(Artifact::class);
    }

    public function getAvailableCountAttribute(): int
    {
        return $this->opened_count + $this->unopened_count;
    }
}
