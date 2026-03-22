<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Artifact extends Model
{
    use HasFactory;

    protected $fillable = [
        'artifact_type',
        'name',
        'maker',
        'model',
        'cpu',
        'memory_gb',
        'storage_gb',
        'display_size',
    ];

    protected function casts(): array
    {
        return [
            'memory_gb' => 'integer',
            'storage_gb' => 'integer',
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }

    public function pcUnits(): HasMany
    {
        return $this->hasMany(PcUnit::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(ArtifactStock::class);
    }

    public function lendings(): HasMany
    {
        return $this->hasMany(Lending::class);
    }
}
