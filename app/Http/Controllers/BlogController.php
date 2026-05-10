<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'video' => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:51200',
        ]);

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('public/blogs/videos');
            $videoPath = basename($videoPath);
        }

        Blog::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'video_path' => $videoPath,
            // Assuming auth user is author if no specific author column
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog article published!');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }
}
