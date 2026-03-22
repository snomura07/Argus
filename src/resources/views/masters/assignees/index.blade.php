@extends('layouts.master')

@section('title', '貸与先管理 | Argus')

@section('content')
<div class="mx-auto max-w-6xl">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h2 class="text-2xl font-semibold">貸与先管理</h2>
        <a href="{{ route('masters.assignees.create') }}" class="rounded bg-slate-800 px-4 py-2 text-sm text-white">貸与先を追加</a>
    </div>

    <form method="GET" action="{{ route('masters.assignees.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="q" value="{{ $keyword }}" placeholder="貸与先名で検索" class="w-full rounded border border-slate-300 bg-white px-3 py-2">
        <button class="rounded bg-slate-600 px-4 py-2 text-white">検索</button>
    </form>

    <div class="overflow-x-auto rounded border border-slate-200 bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">貸与先名</th>
                <th class="px-4 py-3">種別</th>
                <th class="px-4 py-3">操作</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($assignees as $assignee)
                <tr class="border-t border-slate-100">
                    <td class="px-4 py-3">{{ $assignee->id }}</td>
                    <td class="px-4 py-3">{{ $assignee->name }}</td>
                    <td class="px-4 py-3">{{ $assignee->assignee_type }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('masters.assignees.edit', ['assigneeId' => $assignee->id]) }}" class="rounded border border-slate-300 px-3 py-1 text-xs">編集</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-4 py-6 text-center text-slate-500" colspan="4">データがありません。</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $assignees->links() }}
    </div>
</div>
@endsection
