<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Storage;
use App\Http\Requests\MogiRequest;

class MogiController extends Controller
{
    public function index(\illuminate\Http\Request $request)
    {
        $keyword = (string) $request->input('keyword');
        $sort = (string) $request->input('sort');

        $q = \App\Models\Product::query()
            ->when($keyword !=='', function($qb) use ($keyword){
                $qb->where('name', 'like',"%{$keyword}%");
            })
            ->when($sort === 'asc', fn($qb) => $qb->orderBy('price', 'asc'))
            ->when($sort === 'desc', fn($qb) => $qb->orderBy('price', 'desc'));

        $products = $q->paginate(6)->withQueryString();

        return view('products.index', [
            'products' => $products,
            'keyword' => $keyword,
            'sort' => in_array($sort,['asc', 'desc'], true) ? $sort : '',
        ]);
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function update(MogiRequest $request, Product $product)
    {
        $data = $request->validated();

        $product->name        = $data['name'];
        $product->price       = $data['price'];
        $product->seasons     = $data['seasons'];
        $product->description = $data['description'];

        // 画像アップロード
        if ($request->hasFile('image')) {
            // 旧画像の削除
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }

        $path = $request->file('image')->store('products','public');
        $data['image_url'] = Storage::url($path);

        $product->update($data);

        return redirect()->route('products.index')->with('ok','商品を更新しました');
    }
    }

    public function destroy(Product $product){
        // 画像も消す
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();

        return redirect()->route('products.index')->with('ok', '商品を削除しました');
    }

    public function create()
    {
        return view('products.register');
    }

}