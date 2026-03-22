@extends('layouts.master')

@section('title', '貸与先登録 | Argus')

@section('content')
<div class="mx-auto max-w-3xl">
    <h2 class="mb-6 text-2xl font-semibold">貸与先登録</h2>

    @if ($errors->any())
        <div class="mb-4 rounded border border-rose-300 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            入力内容を確認してください。
        </div>
    @endif

    <form method="POST" action="{{ route('masters.assignees.store') }}" class="space-y-4 rounded border border-slate-200 bg-white p-6">
        @csrf

        <div>
            <label for="name" class="mb-1 block text-sm">貸与先名 *</label>
            <input id="name" name="name" value="{{ old('name') }}" class="w-full rounded border border-slate-300 px-3 py-2">
            @error('name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="assignee_type" class="mb-1 block text-sm">種別 *</label>
            <select id="assignee_type" name="assignee_type" class="w-full rounded border border-slate-300 px-3 py-2">
                @foreach ($assigneeTypes as $type)
                    <option value="{{ $type }}" @selected(old('assignee_type') === $type)>{{ $type }}</option>
                @endforeach
            </select>
            @error('assignee_type')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3">
            <button class="rounded bg-slate-800 px-4 py-2 text-white">登録</button>
            <a href="{{ route('masters.assignees.index') }}" class="rounded border border-slate-300 px-4 py-2">戻る</a>
        </div>
    </form>
</div>
@endsection
