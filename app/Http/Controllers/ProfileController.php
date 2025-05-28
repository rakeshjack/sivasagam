<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catimage;
use App\Models\Categorie;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function create()
    {
        return view('pages.profile');
    }

    public function update()
    {
            
        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required',
            'phone' => 'required|max:10',
            'about' => 'required:max:150',
            'location' => 'required'
        ]);

        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    }

    public function category() {
        return view('pages.laravel-examples.add-category');
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
}
