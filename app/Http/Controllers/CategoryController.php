<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategoryController extends Controller {

    public function createCategory() {
        $categories = Categorie::all();
		return view('pages.laravel-examples.user-management',compact('categories'));
	}

    public function destroy($id) {
        $resource = Categorie::findOrFail($id);
        $resource->delete();
        return redirect()->route('user-management')->with('success', 'Resource deleted successfully.');
    }
}
