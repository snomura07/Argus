<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>品目一覧 | Argus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
<div class="mx-auto max-w-6xl px-4 py-8">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-2xl font-semibold">品目一覧</h1>
        <a href="{{ route('artifacts.create') }}" class="rounded bg-slate-800 px-4 py-2 text-sm text-white">品目を追加</a>
    </div>

    @if (session('status'))
        <div class="mb-4 rounded border border-emerald-300 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <form method="GET" action="{{ route('artifacts.index') }}" class="mb-4 flex gap-2">
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
                        <form method="POST" action="{{ route('artifacts.destroy', ['artifactId' => $artifact->id]) }}" onsubmit="return confirm('この品目を削除しますか？');">
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
</body>
</html>
