<?php

namespace App\Http\Controllers;

use App\Repositories\AssigneeRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssigneeController extends Controller
{
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
}
