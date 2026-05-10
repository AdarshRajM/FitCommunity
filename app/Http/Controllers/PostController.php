<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'comments', 'likes'])
            ->where('is_published', true)
            ->where('is_approved', true);

        // Handle Search Query
        if ($request->filled('query')) {
            $searchTerm = $request->input('query');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        // Handle Category/Hashtag Filter
        if ($request->filled('category')) {
            $category = $request->input('category');
            // Assuming we match category against hashtags (stored as JSON array)
            $query->whereJsonContains('hashtags', $category);
        }

        // Handle Sorting
        if ($request->filled('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest();
            } elseif ($request->sort === 'popular') {
                $query->withCount('likes')->orderByDesc('likes_count');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $posts = $query->paginate(10)->withQueryString();

        return view('community.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('community.create');
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'video' => ['nullable', 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4', 'max:51200'],
            'hashtags' => ['nullable', 'string'],
        ]);

        $hashtags = null;
        if ($request->hashtags) {
            $hashtags = array_map('trim', explode(',', $request->hashtags));
        }

        $imagePath = null;
        $videoPath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/posts/images');
            $imagePath = basename($imagePath);
        } elseif ($request->filled('camera_image')) {
            // Handle base64 image from camera
            $imageParts = explode(";base64,", $request->camera_image);
            if (count($imageParts) == 2) {
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1];
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = uniqid() . '.png';
                
                Storage::put('public/posts/images/' . $fileName, $imageBase64);
                $imagePath = $fileName;
            }
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('public/posts/videos');
            $videoPath = basename($videoPath);
        }

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'video' => $videoPath,
            'hashtags' => $hashtags,
            'is_published' => true,
            'is_approved' => true,
        ]);

        return redirect()->route('community.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        $post->increment('views');
        
        $post->load(['user', 'comments.user', 'comments.replies.user', 'likes']);

        return view('community.show', compact('post'));
    }

    /**
     * Show the form for editing the post.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('community.edit', compact('post'));
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'hashtags' => ['nullable', 'string'],
        ]);

        $hashtags = null;
        if ($request->hashtags) {
            $hashtags = array_map('trim', explode(',', $request->hashtags));
        }

        $imagePath = $post->image;

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete('public/posts/images/' . $post->image);
            }
            $imagePath = $request->file('image')->store('public/posts/images');
            $imagePath = basename($imagePath);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'hashtags' => $hashtags,
        ]);

        return redirect()->route('community.show', $post)->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::delete('public/posts/images/' . $post->image);
        }
        if ($post->video) {
            Storage::delete('public/posts/videos/' . $post->video);
        }

        $post->delete();

        return redirect()->route('community.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * Like a post.
     */
    public function like(Post $post)
    {
        $existingLike = $post->likes()->where('user_id', Auth::id())->first();

        if ($existingLike) {
            $existingLike->delete();
            return back()->with('success', 'Post unliked!');
        }

        Like::create([
            'user_id' => Auth::id(),
            'likeable_type' => Post::class,
            'likeable_id' => $post->id,
        ]);

        // Create notification
        if ($post->user_id !== Auth::id()) {
            Notification::create([
                'user_id' => $post->user_id,
                'type' => 'like',
                'title' => 'New Like',
                'message' => Auth::user()->name . ' liked your post: ' . $post->title,
                'link' => route('community.show', $post),
            ]);
        }

        return back()->with('success', 'Post liked!');
    }

    /**
     * Add a comment to a post.
     */
    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        // Create notification
        if ($post->user_id !== Auth::id()) {
            Notification::create([
                'user_id' => $post->user_id,
                'type' => 'comment',
                'title' => 'New Comment',
                'message' => Auth::user()->name . ' commented on your post: ' . $post->title,
                'link' => route('community.show', $post),
            ]);
        }

        return back()->with('success', 'Comment added successfully!');
    }

    /**
     * Delete a comment.
     */
    public function deleteComment(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
