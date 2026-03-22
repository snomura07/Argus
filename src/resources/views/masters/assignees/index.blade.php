@extends('layouts.master')

@section('title', '貸与先マスタ | Argus')

@section('content')
<div class="mx-auto max-w-6xl">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold">貸与先マスタ</h2>
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
            </tr>
            </thead>
            <tbody>
            @forelse ($assignees as $assignee)
                <tr class="border-t border-slate-100">
                    <td class="px-4 py-3">{{ $assignee->id }}</td>
                    <td class="px-4 py-3">{{ $assignee->name }}</td>
                    <td class="px-4 py-3">{{ $assignee->assignee_type }}</td>
                </tr>
            @empty
                <tr>
                    <td class="px-4 py-6 text-center text-slate-500" colspan="3">データがありません。</td>
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
