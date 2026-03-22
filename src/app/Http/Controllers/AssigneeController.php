<?php

namespace App\Http\Controllers;

use App\Actions\CreateAssigneeAction;
use App\Actions\UpdateAssigneeAction;
use App\Http\Requests\StoreAssigneeRequest;
use App\Http\Requests\UpdateAssigneeRequest;
use App\Repositories\AssigneeRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssigneeController extends Controller
{
    private const ASSIGNEE_TYPES = ['person', 'department', 'room', 'project'];

    public function __construct(private readonly AssigneeRepository $assigneeRepository)
    {
    }

    public function index(Request $request): View
    {
        $keyword = $request->string('q')->toString();

        return view('masters.assignees.index', [
            'assignees' => $this->assigneeRepository->paginateWithSearch($keyword),
            'keyword' => $keyword,
            'currentMaster' => 'assignees',
        ]);
    }

    public function create(): View
    {
        return view('masters.assignees.create', [
            'assigneeTypes' => self::ASSIGNEE_TYPES,
            'currentMaster' => 'assignees',
        ]);
    }

    public function store(
        StoreAssigneeRequest $request,
        CreateAssigneeAction $action,
    ): RedirectResponse {
        $assignee = $action($request->validated());

        return redirect()
            ->route('masters.assignees.index')
            ->with('status', '貸与先を登録しました: '.$assignee->name);
    }

    public function edit(int $assigneeId): View
    {
        return view('masters.assignees.edit', [
            'assignee' => $this->assigneeRepository->findById($assigneeId),
            'assigneeTypes' => self::ASSIGNEE_TYPES,
            'currentMaster' => 'assignees',
        ]);
    }

    public function update(
        int $assigneeId,
        UpdateAssigneeRequest $request,
        UpdateAssigneeAction $action,
    ): RedirectResponse {
        $assignee = $action($assigneeId, $request->validated());

        return redirect()
            ->route('masters.assignees.index')
            ->with('status', '貸与先を更新しました: '.$assignee->name);
    }
}
