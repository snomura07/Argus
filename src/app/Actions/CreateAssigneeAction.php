<?php

namespace App\Actions;

use App\Models\Assignee;
use App\Repositories\AssigneeRepository;
use Illuminate\Support\Facades\DB;

class CreateAssigneeAction
{
    public function __construct(private readonly AssigneeRepository $assigneeRepository)
    {
    }

    public function __invoke(array $attributes): Assignee
    {
        return DB::transaction(
            fn (): Assignee => $this->assigneeRepository->create($attributes)
        );
    }
}
