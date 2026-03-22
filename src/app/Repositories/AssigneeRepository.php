<?php

namespace App\Repositories;

use App\Models\Assignee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AssigneeRepository
{
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
}
