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
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-cyan-100 px-6 py-6 text-2xl font-bold text-cyan-900 shadow-sm">納品</button>
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-indigo-100 px-6 py-6 text-2xl font-bold text-indigo-900 shadow-sm">貸与/貸出</button>
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-emerald-100 px-6 py-6 text-2xl font-bold text-emerald-900 shadow-sm">回収</button>
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-amber-100 px-6 py-6 text-2xl font-bold text-amber-900 shadow-sm">修理</button>
            <button type="button" class="flex min-h-36 items-center justify-center rounded-xl bg-rose-100 px-6 py-6 text-2xl font-bold text-rose-900 shadow-sm">廃棄</button>
        </div>
    </section>

    <section class="mb-10">
        <h3 class="mb-4 text-lg font-semibold text-slate-800">貸与先関連</h3>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            <a href="{{ route('masters.assignees.index') }}" class="flex min-h-36 items-center justify-center rounded-xl bg-slate-200 px-6 py-6 text-2xl font-bold text-slate-900 shadow-sm">貸与先管理</a>
        </div>
    </section>
</div>
@endsection
