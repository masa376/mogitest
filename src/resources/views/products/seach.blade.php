<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="logo">mogitate</div>
        </div>
    </header>

    <main class="container">
        {{-- 左側の検索フォーム --}}
        <aside class="sidebar">
            <h1 class="title">「{{ $keyword }}」の商品一覧</h1>

            <form method="GET" action="{{ url('/products/search') }}" class="search-form">
                <input type="text" name="keyword" class="input" placeholder="商品名で検索" value="{{ $keyword }}">
                <button class="btn-search" type="submit">検索</button>

                <div class="sort-box">
                    <p class="sort-title">価格順で表示</p>
                    <select name="sort" class="select" onchange="this.form.submit()">
                        <option value="">価格で並び替え</option>
                        <option value="asc" {{ request('sort')==='asc' ? 'selected' : '' }}>安い順</option>
                        <option value="desc" {{ request('sort')==='desc' ? 'selected' : '' }}>高い順</option>
                    </select>
                </div>
            </form>
        </aside>

        {{-- 右側の商品一覧 --}}
        <section class="products">
            @if($products->isEmpty())
                <p class="no-result">該当する商品はありません。</p>
            @else
                <div class="grid">
                    @foreach($products as $product)
                        <div class="card">
                            <img src="{{ $product->image_url ?? asset('/images/noimage.png') }}" alt="{{ $product->name }}">
                            <div class="card-body">
                                <p class="product-name">{{ $product-name }}</p>
                                <p class="product-price">¥{{ number_format($product->price) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                @endif
        </section>
    </main>
</body>
</html>