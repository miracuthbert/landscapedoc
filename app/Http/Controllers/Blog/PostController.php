<?php

namespace App\Http\Controllers\Blog;

use App\Models\Category;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->category;
        $author = $request->author;

        if (isset($category)) {
            $category = Category::where('slug', $category)->firstOrFail();

            $posts = Post::with(['category', 'user', 'ratings'])->fromCategory($category)->latestFirst()->paginate();
        } elseif (isset($author)) {
            $author = User::findOrFail($author);

            $posts = Post::with(['category', 'user', 'ratings'])->byAuthor($author)->latestFirst()->paginate();
        } else {
            $posts = Post::with(['category', 'user', 'ratings'])->latestFirst()->paginate();
        }

        $category = !empty($category->id) ? $category->slug : $category;
        $author = !empty($author->id) ? $author->id : $author;

        return view('blog.index', compact('posts', 'category', 'author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post = Post::with(['category', 'user', 'ratings'])->findOrFail($post);

        $blog = Category::with(['ancestors', 'children'])
            ->where('slug', 'blog')->first();

        $categories = $blog->children()
            ->where('status', true)
            ->whereNotNull('parent_id')
            ->get()->toFlatTree();

        return view('blog.show', compact('categories', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
