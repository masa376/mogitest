<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/show.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="logo">mogitate</div>
        </div>
    </header>

    <main class="container">
        <nav class="breadcrumb">
            <a href="{{ url('/products') }}">商品一覧</a>
            <span>></span>
            <span>{{ $product->name }}</span>
        </nav>

        {{--更新フォーム --}}
        <form class="form" action="{{ url('/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid">
                {{-- 左：画像プレビュー & アップロード --}}
                <div class="image-area">
                    <div class="image-wrap">
                        <img src="{{ $product->image_url ?? asset('images/noimage.png') }}"
                        alt="{{ $product->name }}">
                    </div>

                    <label class="file">
                        <input type="file" name="image" accept="image/png,image/jpeg">
                        ファイルを選択
                    </label>
                    <span class="file-name">
                    {{ old('image') ? old('image') : (basename($product->image_url ?? '') ?: '') }}
                    </span>

                    @error('image')
                    <p class="error">{{ $message }}</p>
                    <p class="error">「.png」または「.jpeg」形式でアップロードしてください</p>
                    @enderror
                </div>

                {{-- 右：テキスト項目 --}}
                <div class="fields">
                    <label class="label">商品名
                        <input class="input" type="text" name="name" value="{{ old('name', $product->name) }}"
                        placeholder="商品名を入力">
                    </label>
                    @error('name') <p class="error">{{ $message }}</p> @enderror

                    <label class="label">値段
                        <input class="input" type="number" name="price" min="0" max="10000" step="1"
                        value="{{ old('price', $product->price) }}"
                        placeholder="値段を入力">
                    </label>
                    @error('price')
                        <p class="error">{{ $message }}</p>
                        <p class="error">数値で入力してください</p>
                        <p class="error">0~10000円以内で入力してください</p>
                    @enderror

                    @php
                        $options = [
                            'spring' => '春',
                            'summer' => '夏',
                            'fall' => '秋',
                            'winter' => '冬',
                        ];
                        $selectedSeasons = (array) old('seasons', $product->seasons ?? []);
                    @endphp
                    <div class="label">季節</div>
                    <div class="seasons">
                        @foreach($options as $val => $label)
                            <label class="season">
                                <input type="checkbox" name="seasons[]"
                                value="{{ $val }}" {{ in_array($val, $selectSeasons)? 'checked' : ''}}>
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('seasons') <p class="error">季節を選択してください</p> @enderror
                </div>
            </div>

            <div class="desc-block">
                <label class="label">商品説明
                    <textarea class="textarea" name="description" rows="6" maxlength="120"
                    placeholder="商品の説明を入力">{{ old('desrcriptin', $product->description) }}</textarea>
                </label>
                @error('description')
                    <p class="error">商品説明を入力してください</p>
                    <p class="error">120文字以内で入力してください</p>
                @enderror
            </div>

            <div class="actions">
                <button class="btn btn--ghost" type="button" onclick="history.back()">戻る</button>
                <button class="btn btn--primary" type="submit">変更を保存</button>
                <!-- シンプルなゴミ箱アイコン ⇒Flgma内に用意あり-->
            </div>
        </form>
    </main>
</body>
</html>