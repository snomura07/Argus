<?php

namespace App\Actions;

use App\Models\Artifact;
use App\Repositories\ArtifactRepository;
use App\Repositories\PcUnitRepository;
use Illuminate\Support\Facades\DB;

class CreateArtifactAction
{
    public function __construct(
        private readonly ArtifactRepository $artifactRepository,
        private readonly PcUnitRepository $pcUnitRepository,
    )
    {
    }

    public function __invoke(array $attributes): Artifact
    {
        $quantity = (int) ($attributes['unit_quantity'] ?? 0);
        unset($attributes['unit_quantity']);

        return DB::transaction(function () use ($attributes, $quantity): Artifact {
            $artifact = $this->artifactRepository->create($attributes);

            if ($artifact->artifact_type === 'pc') {
                $this->pcUnitRepository->createForArtifact($artifact->id, $quantity);
            }

            return $artifact;
        });
    }
}
