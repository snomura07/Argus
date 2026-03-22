<?php

namespace App\Repositories;

use App\Models\Artifact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArtifactRepository
{
    public function paginateWithSearch(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        return Artifact::query()
            ->when(
                filled($keyword),
                fn ($query) => $query->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('maker', 'like', '%'.$keyword.'%')
                    ->orWhere('model', 'like', '%'.$keyword.'%')
            )
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function create(array $attributes): Artifact
    {
        return Artifact::query()->create($attributes);
    }
}
