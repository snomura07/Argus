@extends('layouts.master')

@section('title', '品目登録 | Argus')

@section('content')
<div class="mx-auto max-w-3xl">
    <h2 class="mb-6 text-2xl font-semibold">品目登録</h2>

    @if ($errors->any())
        <div class="mb-4 rounded border border-rose-300 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            入力内容を確認してください。
        </div>
    @endif

    <form method="POST" action="{{ route('masters.artifacts.store') }}" class="space-y-4 rounded border border-slate-200 bg-white p-6">
        @csrf

        <div>
            <label for="artifact_type" class="mb-1 block text-sm">種別 *</label>
            <select id="artifact_type" name="artifact_type" class="w-full rounded border border-slate-300 px-3 py-2">
                @foreach ($artifactTypes as $type)
                    <option value="{{ $type }}" @selected(old('artifact_type') === $type)>{{ $type }}</option>
                @endforeach
            </select>
            @error('artifact_type')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="name" class="mb-1 block text-sm">品目名 *</label>
            <input id="name" name="name" value="{{ old('name') }}" class="w-full rounded border border-slate-300 px-3 py-2">
            @error('name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label for="maker" class="mb-1 block text-sm">メーカー</label>
                <input id="maker" name="maker" value="{{ old('maker') }}" class="w-full rounded border border-slate-300 px-3 py-2">
                @error('maker')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="model" class="mb-1 block text-sm">型番</label>
                <input id="model" name="model" value="{{ old('model') }}" class="w-full rounded border border-slate-300 px-3 py-2">
                @error('model')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label for="cpu" class="mb-1 block text-sm">CPU</label>
                <input id="cpu" name="cpu" value="{{ old('cpu') }}" class="w-full rounded border border-slate-300 px-3 py-2">
                @error('cpu')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="memory_gb" class="mb-1 block text-sm">メモリ(GB)</label>
                <input id="memory_gb" type="number" name="memory_gb" value="{{ old('memory_gb') }}" class="w-full rounded border border-slate-300 px-3 py-2">
                @error('memory_gb')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="storage_gb" class="mb-1 block text-sm">ストレージ(GB)</label>
                <input id="storage_gb" type="number" name="storage_gb" value="{{ old('storage_gb') }}" class="w-full rounded border border-slate-300 px-3 py-2">
                @error('storage_gb')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label for="display_size" class="mb-1 block text-sm">画面サイズ</label>
            <input id="display_size" name="display_size" value="{{ old('display_size') }}" class="w-full rounded border border-slate-300 px-3 py-2">
            @error('display_size')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="unit_quantity" class="mb-1 block text-sm">PC台数（種別がpcのとき必須）</label>
            <input id="unit_quantity" type="number" name="unit_quantity" value="{{ old('unit_quantity') }}" class="w-full rounded border border-slate-300 px-3 py-2" min="1">
            <p class="mt-1 text-xs text-slate-500">入力された台数分のPC個体を自動作成し、管理番号を採番します。</p>
            @error('unit_quantity')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3">
            <button class="rounded bg-slate-800 px-4 py-2 text-white">登録</button>
            <a href="{{ route('masters.artifacts.index') }}" class="rounded border border-slate-300 px-4 py-2">戻る</a>
        </div>
    </form>
</div>
@endsection
