@extends('layouts.master')

@section('title', 'ダッシュボード | Argus')

@section('content')
<div class="mx-auto max-w-6xl">
    <div class="mb-8">
        <h2 class="text-3xl font-semibold">ダッシュボード</h2>
        <p class="mt-1 text-sm text-slate-500">業務メニュー</p>
    </div>

    <section class="mb-10">
        <h3 class="mb-4 text-lg font-semibold text-slate-800">機器関連</h3>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-cyan-600 px-6 py-6 text-2xl font-bold text-white shadow-sm">納品</button>
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-indigo-600 px-6 py-6 text-2xl font-bold text-white shadow-sm">貸与/貸出</button>
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-emerald-600 px-6 py-6 text-2xl font-bold text-white shadow-sm">回収</button>
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-amber-500 px-6 py-6 text-2xl font-bold text-white shadow-sm">修理</button>
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-rose-600 px-6 py-6 text-2xl font-bold text-white shadow-sm">廃棄</button>
        </div>
    </section>

    <section class="mb-10">
        <h3 class="mb-4 text-lg font-semibold text-slate-800">貸与先関連</h3>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            <a href="{{ route('masters.assignees.index') }}" class="flex min-h-36 items-center justify-center rounded-xl bg-slate-800 px-6 py-6 text-2xl font-bold text-white shadow-sm">貸与先管理</a>
        </div>
    </section>

    <div class="mb-6 flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 pt-8">
        <h3 class="text-2xl font-semibold">品目マスタ</h3>
        <a href="{{ route('masters.artifacts.create') }}" class="rounded bg-slate-800 px-4 py-2 text-sm text-white">品目を追加</a>
    </div>

    <form method="GET" action="{{ route('masters.artifacts.index') }}" class="mb-4 flex gap-2">
        <input
            type="text"
            name="q"
            value="{{ $keyword }}"
            placeholder="品目名・メーカー・型番で検索"
            class="w-full rounded border border-slate-300 bg-white px-3 py-2"
        >
        <button class="rounded bg-slate-600 px-4 py-2 text-white">検索</button>
    </form>

    <div class="overflow-x-auto rounded border border-slate-200 bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">種別</th>
                <th class="px-4 py-3">品目名</th>
                <th class="px-4 py-3">メーカー</th>
                <th class="px-4 py-3">型番</th>
                <th class="px-4 py-3">操作</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($artifacts as $artifact)
                <tr class="border-t border-slate-100">
                    <td class="px-4 py-3">{{ $artifact->id }}</td>
                    <td class="px-4 py-3">{{ $artifact->artifact_type }}</td>
                    <td class="px-4 py-3">{{ $artifact->name }}</td>
                    <td class="px-4 py-3">{{ $artifact->maker ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $artifact->model ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('masters.artifacts.destroy', ['artifactId' => $artifact->id]) }}" onsubmit="return confirm('この品目を削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded bg-rose-600 px-3 py-1 text-xs text-white">削除</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-4 py-6 text-center text-slate-500" colspan="6">データがありません。</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $artifacts->links() }}
    </div>
</div>
@endsection
