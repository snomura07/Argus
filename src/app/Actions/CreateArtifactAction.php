<?php

namespace App\Actions;

use App\Models\Artifact;
use App\Repositories\ArtifactRepository;
use Illuminate\Support\Facades\DB;

class CreateArtifactAction
{
    public function __construct(private readonly ArtifactRepository $artifactRepository)
    {
    }

    public function __invoke(array $attributes): Artifact
    {
        return DB::transaction(fn () => $this->artifactRepository->create($attributes));
    }
}
