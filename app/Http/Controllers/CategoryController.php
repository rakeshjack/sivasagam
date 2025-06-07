<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Catimage;

class CategoryController extends Controller {

    public function category() {
        return view('pages.laravel-examples.add-category');
    }
    public function createCategory() {
        $categories = Categorie::with('catimages')->get();
		return view('pages.laravel-examples.user-management',compact('categories'));
	}

    public function updateCategory($id) {
        $categories = Categorie::with('catimages')->findOrFail($id);
        return view('pages.laravel-examples.update-category',compact('categories'));
    }

    public function saveCategories(Request $request) {
        $category = Categorie::findOrFail($request->categoryid);
        $category->name =$request->name;
        $category->fullname=$request->fullname;
        $category->save();
        return redirect()->route('user-management');
    }

    public function viewCategoryImage($id,$catImageId = null) {
        $category = Categorie::with('catimages')->findOrFail($id);
        $image = null;
        if($catImageId) {
            $image = Catimage::findOrFail($catImageId);
            return view('pages.laravel-examples.image-category',compact('category','image'));
        }
        return view('pages.laravel-examples.image-category',compact('category','image'));
    }

    public function saveTemple(Request $request) {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $catId = Categorie::create([
            'name' =>$request->name,
            'fullname' =>$request->name
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                Catimage::create([
                    'image_name' =>$path,
                    'category_id' =>$catId->id,
                    'path' => $path,
                ]);
            }
        }
        return redirect()->route('user-management');
    }

    public function saveImageDescription(Request $request) {
        $catImageId = $request->catImageId;
        $catId = $request->catId;
        if ($request->hasFile('images') && $request->file('images')->isValid()) {
            $path = $request->file('images')->store('images', 'public');
        }
        if($catImageId) {
            $categoryImage = Catimage::findOrFail($catImageId);
            $categoryImage->name =$request->name;
            $categoryImage->description=$request->description;
            $categoryImage->address = $request->address;
            $categoryImage->category_id =$catId;
            if ($request->hasFile('images') && $request->file('images')->isValid()) {
                $categoryImage->path = $path;
            }
            $categoryImage->save();
        } else {
            Catimage::create([
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'image_name'  => $path,
                'category_id' => $catId,
                'path'        => $path,
            ]);
        }
        return redirect()->route('user-management');
    }

    public function destroy($id) {
        $resource = Categorie::findOrFail($id);
        $resource->delete();
        return redirect()->route('user-management')->with('success', 'Resource deleted successfully.');
    }
}
