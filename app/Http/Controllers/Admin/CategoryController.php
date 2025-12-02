<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|string|max:100"
        ]);

        Category::create([
            "nama" => $request->nama,
            "slug" => Str::slug($request->nama)
        ]);

        return redirect()->route('admin.kategori.index')->with("success", "Kategori berhasil ditambahkan!");
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.kategori.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            "nama" => "required"
        ]);

        $category->update([
            "nama" => $request->nama,
            "slug" => Str::slug($request->nama)
        ]);

        return redirect()->route('admin.kategori.index')->with("success","Kategori diperbarui!");
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with("success","Kategori dihapus!");
    }
}
