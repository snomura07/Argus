<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'マスタ管理 | Argus')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
<div class="min-h-screen md:flex">
    <aside class="w-full border-b border-slate-200 bg-white md:min-h-screen md:w-64 md:border-b-0 md:border-r">
        <div class="border-b border-slate-200 px-5 py-4">
            <p class="text-xs text-slate-500">Argus</p>
            <h1 class="text-lg font-semibold">マスタ管理</h1>
        </div>

        <nav class="space-y-1 p-3 text-sm">
            <a href="{{ route('masters.artifacts.index') }}" class="block rounded px-3 py-2 {{ ($currentMaster ?? '') === 'artifacts' ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}">品目マスタ</a>
            <a href="{{ route('masters.assignees.index') }}" class="block rounded px-3 py-2 {{ ($currentMaster ?? '') === 'assignees' ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}">貸与先マスタ</a>
        </nav>
    </aside>

    <main class="flex-1 px-4 py-6 md:px-8 md:py-8">
        @if (session('status'))
            <div class="mb-4 rounded border border-emerald-300 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>
