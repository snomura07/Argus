<?php

namespace App\Actions;

use App\Repositories\ArtifactRepository;
use Illuminate\Support\Facades\DB;

class DeleteArtifactAction
{
    public function __construct(private readonly ArtifactRepository $artifactRepository)
    {
    }

    public function __invoke(int $artifactId): string
    {
        return DB::transaction(fn () => $this->artifactRepository->deleteById($artifactId));
    }
}
