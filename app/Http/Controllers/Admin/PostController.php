<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Показ всех статей
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('admin.post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Категории в 'добавить статью'
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('admin.post.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Добавление статьи
        $post = new Post();
        $post->title = $request->title;
        $post->img = '/'.$request->img;
        $post->text = $request->text;
        $post->cat_id = $request->cat_id;
        $post->save();

        return redirect()->back()->withSuccess('Статья успешно добавлена!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        //Редактирование статей
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('admin.post.edit', [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Редактирование поста
        $post->title = $request->title;
        $post->img = '/'.$request->img;
        $post->text = $request->text;
        $post->cat_id = $request->cat_id;
        $post->save();

        return redirect()->back()->withSuccess('Статья успешно обновлена!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Удаление поста
        $post->delete();
        return redirect()->back()->withSuccess('Статья была успешна удалена');
    }
}
