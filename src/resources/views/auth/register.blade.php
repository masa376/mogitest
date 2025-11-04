<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
<header class="header">
    <div class="header__inner"><div class="logo">mogitate</div></div>
</header>

<main class="wrap">
    <h1 class="title">商品登録</h1>

    <form class="form" method="POST" action="{{ url('/products/register') }}" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <label class="label">商品名 <span class="req">必須</span></label>
        <input class="input" type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
        @error('name') <p class="error">{{ $message }}</p> @enderror

        {{-- 値段 --}}
        <label class="label">値段 <span class="req">必須</span></label>
        <input class="input" type="number" name="price" value="{{ old('price') }}" min="0" max="10000" placeholder="値段を入力">
        @error('price')
            <p class="error">値段を入力してください</p>
            <p class="error">数値で入力してください</p>
            <p class="error">0~10000円以内で入力してください</p>
        @enderror

        {{-- 商品画像 --}}
        <label class="label">商品画像 <span class="req">必須</span></label>
        <div class="image-block">
            <img id="preview" src="" alt="" class="preview" style="display:none;">
        </div>
        <div class="file-line">
            <input class="file" type="file" name="image" id="image" accept="image/png,image/jpeg">
            <span id="fileName" class="file-name"></span>
        </div>
        @error('image')
            <p class="error">商品画像を登録してください</p>
            <p class="error">「.png」または「.jpeg」形式でアップロードしてください</p>
        @enderror

        {{-- 季節（複数可） --}}
        <div class="label-row">
            <span class="label">季節 <span class="req">必須</span></span>
            <span class="note">複数選択可</span>
        </div>
        @php
            $options = ['spring'=>'春','summer'=>'夏','fall'=>'秋','winter'=>'冬'];
            $selected = (array) old('seasons', []);
        @endphp
        <div class="seasons">
            @foreach($options as $val=>$text)
                <label class="season">
                    <input class="checkbox" name="seasons[]" value="{{ $val }}" {{ in_array($val, $selected) ? 'checked' : '' }}>
                    <span>{{ $text }}</span>
                </label>
            @endforeach
        </div>
        @error('seasons') <p class="error">季節を選択してください</p> @enderror

        {{-- 商品説明 --}}
        <label class="label">商品説明 <span class="req">必須</span></label>
        <textarea class="textarea" name="description" rows="6" maxlength="120" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        @error('description')
            <p class="error">商品説明を入力してください</p>
            <p class="error">120文字以内で入力してください</p>
        @enderror

        {{-- ボタン --}}
        <div class="buttons">
            <a href="{{ url('/products') }}" class="btn btn--gray" role="button">戻る</a>
            <button type="submit" class="btn btn--yellow">登録</button>
        </div>
    </form>
</main>

// 画像の簡単プレビュー＆ファイル名表示
</body>
</html>