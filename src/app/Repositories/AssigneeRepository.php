<?php

namespace App\Repositories;

use App\Models\Assignee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AssigneeRepository
{
    public function create(array $attributes): Assignee
    {
        return Assignee::query()->create($attributes);
    }

    public function paginateWithSearch(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        return Assignee::query()
            ->when(
                filled($keyword),
                fn ($query) => $query->where('name', 'like', '%'.$keyword.'%')
            )
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findById(int $assigneeId): Assignee
    {
        return Assignee::query()->findOrFail($assigneeId);
    }

    public function updateById(int $assigneeId, array $attributes): Assignee
    {
        $assignee = $this->findById($assigneeId);
        $assignee->fill($attributes);
        $assignee->save();

        return $assignee;
    }
}
