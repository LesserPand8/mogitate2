<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class MogitateController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function register()
    {
        return view('register');
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0|max:10000',
            'image' => 'required|image|mimes:jpeg,png',
            'seasons' => 'required|array',
            'description' => 'required|max:120',
        ]);

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
}
