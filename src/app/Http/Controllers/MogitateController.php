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

        // 画像をpublic/imageに保存
        $imageFile = $request->file('image');
        $imageName = uniqid() . '_' . $imageFile->getClientOriginalName();
        $imageFile->move(public_path('image'), $imageName);

        // 商品を保存
        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => 'image/' . $imageName, // ← public/image/ファイル名
            'description' => $validated['description'],
        ]);

        // 季節の紐付け（product_season中間テーブル）
        $seasonIds = Season::whereIn('name', $validated['seasons'])->pluck('id');
        $product->seasons()->sync($seasonIds);

        return redirect('/products');
    }

    public function show(Request $request, $id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('detail', compact('product'));
    }
}
