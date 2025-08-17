<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RegisterRequest;

class MogitateController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 商品名検索
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え
        if ($request->sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('price', 'desc');
        }

        // 6件ごとにページネーション
        $products = $query->paginate(6);

        return view('index', compact('products'));
    }

    public function register()
    {
        return view('register');
    }

    public function add(RegisterRequest $request)
    {
        $validated = $request->validated();

        // 画像をstorage/app/public/productsに保存
        $imageFile = $request->file('image');
        $imageName = uniqid() . '_' . $imageFile->getClientOriginalName();
        $imageFile->storeAs('public/products', $imageName);

        // 商品を保存
        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => 'products/' . $imageName, // ← storageパスに変更
            'description' => $validated['description'],
        ]);

        // 季節の紐付け
        $seasonIds = Season::whereIn('name', $validated['seasons'])->pluck('id');
        $product->seasons()->sync($seasonIds);

        return redirect('/products');
    }

    public function show(Request $request, $id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('detail', compact('product'));
    }

    public function delete(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products');
    }

    public function update(RegisterRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validated();

        // 画像がアップロードされた場合のみ保存
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = uniqid() . '_' . $imageFile->getClientOriginalName();
            $imageFile->storeAs('public/products', $imageName);
            $product->image = 'products/' . $imageName;
        }

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->save();

        // 季節の紐付け更新
        if ($request->filled('seasons')) {
            $seasonIds = Season::whereIn('name', $request->input('seasons'))->pluck('id');
            $product->seasons()->sync($seasonIds);
        }

        return redirect('/products');
    }
}
