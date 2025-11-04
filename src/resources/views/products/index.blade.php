<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>mogitate | 商品一覧</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
</head>
<body>
<header class="header">
    <div class="header__inner">
    <div class="logo">mogitate</div>
    <a class="button button--primary" href="{{ route('products.create') }}">＋ 商品を追加</a>
    </div>
</header>

<main class="container">
    {{-- 左：検索 & 並び替え --}}
    <aside class="sidebar">
    <h1 class="page-title">商品一覧</h1>

    <form method="GET" action="{{ route('products.search') }}" class="search-card">
        <input class="input" type="text" name="keyword" value="{{ $keyword }}" placeholder="商品名で検索">
        <button class="button button--search" type="submit">検索</button>

        <div class="mt-16">
        <p class="muted">価格順で表示</p>
        <select class="select" name="sort" onchange="this.form.submit()">
            <option value="">価格で並べ替え</option>
            <option value="desc" {{ $sort==='desc' ? 'selected' : '' }}>高い順に表示</option>
            <option value="asc"  {{ $sort==='asc'  ? 'selected' : '' }}>低い順に表示</option>
        </select>

        {{-- 並び替えタグ表示（×でリセット） --}}
        @if($sort)
        <div class="tag-wrap">
            <a class="tag">
                {{ $sort==='desc' ? '高い順に表示' : '低い順に表示' }}
                {{-- 現在の keyword を保持したまま sort だけ外す --}}
            <a class="tag__close"
                href="{{ request()->fullUrlWithQuery(['sort'=>null]) }}"
                aria-label="並び替えをリセット">×</a>
            </a>
        </div>
        @endif
        </div>
    </form>
</aside>


    <section class="grid">
    @forelse ($products as $p)
        <article class="card">
        <a class="card__media" href="{{ route('products.show', $p) }}">
            <img src="{{ $p->image_url ?? asset('images/noimage.png') }}" alt="{{ $p->name }}">
        </a>
        <div class="card__body">
            <h2 class="card__title">{{ $p->name }}</h2>
            <div class="card__price">¥{{ number_format($p->price) }}</div>
        </div>
        </article>
    @empty
        <p>該当する商品はありません。</p>
    @endforelse
    </section>
</main>

{{-- ページネーション（6件/ページ） --}}
@if ($products->lastPage() > 1)
    <nav class="pager" aria-label="ページネーション">
    <a class="pager__arrow {{ $products->onFirstPage() ? 'is-disabled' : '' }}"
        href="{{ $products->previousPageUrl() ?? '#' }}">‹</a>

    @for ($p = 1; $p <= $products->lastPage(); $p++)
    <a class="pager__page {{ $p === $products->currentPage() ? 'is-current' : '' }}"
        href="{{ $products->url($p) }}">{{ $p }}</a>
    @endfor

    <a class="pager__arrow {{ $products->currentPage() === $products->lastPage() ? 'is-disabled' : '' }}"
        href="{{ $products->nextPageUrl() ?? '#' }}">›</a>
    </nav>
@endif
</body>
</html>
