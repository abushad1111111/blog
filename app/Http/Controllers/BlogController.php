<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function blogList()
    {
        $blogs = Blog::all();
        return view('backend.blogs.list', compact('blogs'));
    }

    public function blogForm()
    {
        return view('backend.blogs.create');
    }

    public function blogCreate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $blogData = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
           $filePath = Storage::disk('public')->put('images/posts', request()->file('image'));
           $blogData['image'] = $filePath;
        }

        Blog::create($blogData);

        return redirect()->route('blog.list')->with('success', 'Blog post created successfully.');
    }

    public function blogEdit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('backend.blogs.edit', compact('blog'));
    }

    public function blogUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image
        ]);
        $blog = Blog::findOrFail($id);

        $blogData = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
            // delete image
            if($blog->image){
                Storage::disk('public')->delete($blog->image);
            }

            $filePath = Storage::disk('public')->put('images/posts', request()->file('image'), 'public');
            $blogData['image'] = $filePath;
        }

        $blog->update($blogData);

        return redirect()->route('blog.list')->with('success', 'Blog post updated successfully.');
    }

    public function blogDestroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();
        return redirect()->route('blog.list')->with('success', 'Blog post deleted successfully.');
    }
}
