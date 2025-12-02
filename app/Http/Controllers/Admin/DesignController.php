<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Category;
use App\Models\ContentMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignController extends Controller
{
    public function index()
    {
        $designs = Design::with('categories')->get();
        return view('admin.design.index', compact('designs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.design.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|string|max:100",
            "deskripsi" => "required|string",
            "harga" => "required|numeric",
            "kategori" => "array",
            "files.*" => "image|mimes:jpg,jpeg,png|max:2048"
        ]);

        $design = Design::create([
            "created_by" => Auth::id(),
            "nama" => $request->nama,
            "deskripsi" => $request->deskripsi,
            "harga" => $request->harga
        ]);

        // insert kategori
        if ($request->kategori) {
            $design->categories()->attach($request->kategori);
        }

        // upload file gambar
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store("uploads/designs", "public");

                ContentMedia::create([
                    "design_id" => $design->id,
                    "file_path" => $path
                ]);
            }
        }

        return redirect()->route('admin.design.index')
            ->with("success", "Desain berhasil disimpan!");
    }

    public function edit($id)
    {
        $design = Design::with(['categories', 'contents'])->findOrFail($id);
        $categories = Category::all();

        return view('admin.design.edit', compact('design','categories'));
    }

    public function update(Request $request, $id)
    {
        $design = Design::findOrFail($id);

        $request->validate([
            "nama" => "required",
            "deskripsi" => "required",
            "harga" => "required|numeric",
            "kategori" => "array"
        ]);

        $design->update([
            "nama" => $request->nama,
            "deskripsi" => $request->deskripsi,
            "harga" => $request->harga
        ]);

        // update kategori
        $design->categories()->sync($request->kategori);

        return redirect()->route('admin.design.edit', $design->id)
            ->with("success", "Desain berhasil diperbarui!");
    }

    // Upload gambar tambahan
    public function uploadMedia(Request $request, $id)
    {
        $request->validate([
            "file" => "required|image|mimes:jpg,png,jpeg|max:2048"
        ]);

        $path = $request->file("file")->store("uploads/designs","public");

        ContentMedia::create([
            "design_id" => $id,
            "file_path" => $path
        ]);

        return back()->with("success", "Gambar berhasil diupload");
    }

    public function deleteMedia($id)
    {
        $media = ContentMedia::findOrFail($id);
        $media->delete();

        return back()->with("success","Gambar berhasil dihapus");
    }

    public function destroy($id)
    {
        $design = Design::findOrFail($id);
        $design->delete();

        return redirect()->route('admin.design.index')
            ->with("success","Desain berhasil dihapus");
    }
}
