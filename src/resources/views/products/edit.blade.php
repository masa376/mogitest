<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="logo">mogitate</div>
        </div>
    </header>

    <main class="container">
        <h1 class="title">商品情報の編集</h1>

        <form class="form" method="POST" action="{{ url('/products/'.$product->id.'/edit') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- 画像エリア --}}
            <div class="image-section">
                <img sec="{{ $product->image_url ?? asset('images/noimage.png') }}" alt="{{ $product->name }}">
                <input type="file" name="image">
                @error('image')<p class="error">{{ $message }}</p>@enderror
            </div>

            {{-- 入力エリア --}}
            <div class="form-group">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                @error('name')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>値段（円）</label>
                <input type="number" name="price" min="0" max="10000" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                @error('price')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>季節</label>
                @php
                    $seasons = ['春','夏','秋','冬'];
                    $selected = old('season', $product->season);
                @endphp
                <div class="seasons">
                    @foreach($seasons as $s)
                        <label><input type="radio" name="season" value="{{ $s }}" {{ $selected === $s ? 'checked' : '' }}> {{ $s }}</label>
                    @endforeach
                </div>
                @error('season')<p class="error">{{ $message }}</p>@enderror
            </div>

            {{-- ボタン --}}
            <div class="buttons">
                <a href="{{ url('/products') }}" class="btn back">戻る</a>
                <button type="submit" class="btn submit">変更を保存</button>
            </div>
        </form>
    </main>
</body>
</html>