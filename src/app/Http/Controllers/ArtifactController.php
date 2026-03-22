<?php

namespace App\Http\Controllers;

use App\Actions\CreateArtifactAction;
use App\Actions\DeleteArtifactAction;
use App\Http\Requests\StoreArtifactRequest;
use App\Repositories\ArtifactRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtifactController extends Controller
{
    public function __construct(private readonly ArtifactRepository $artifactRepository)
    {
    }

    public function index(Request $request): View
    {
        $keyword = $request->string('q')->toString();

        return view('masters.artifacts.index', [
            'artifacts' => $this->artifactRepository->paginateWithSearch($keyword),
            'keyword' => $keyword,
            'currentMaster' => 'artifacts',
        ]);
    }

    public function create(): View
    {
        return view('masters.artifacts.create', [
            'artifactTypes' => ['pc', 'monitor', 'keyboard', 'mouse', 'other'],
            'currentMaster' => 'artifacts',
        ]);
    }

    public function store(StoreArtifactRequest $request, CreateArtifactAction $action): RedirectResponse
    {
        $artifact = $action($request->validated());

        return redirect()
            ->route('masters.artifacts.index')
            ->with('status', '品目を登録しました: '.$artifact->name);
    }

    public function destroy(int $artifactId, DeleteArtifactAction $action): RedirectResponse
    {
        $deletedName = $action($artifactId);

        return redirect()
            ->route('masters.artifacts.index')
            ->with('status', '品目を削除しました: '.$deletedName);
    }
}
