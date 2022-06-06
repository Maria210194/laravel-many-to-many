<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;

class PostController extends Controller
{
    public function index()
    {
        //
        $posts= Post::all();
        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.posts.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required|max:250',
            'content'=>'required|min:5',
            'category_id'=>'required|exists:categories,id'
            ],
            [
                'title.required'=>'Il titolo dev\'essere valorizzato',
                'title.max'=>'Hai superato i 250 caratteri',
                'content.min'=>':attribute deve avere almeno :min caratteri',
                'category_id.exists'=> 'La categoria selezionata non esiste'
            ]);

            $postData = $request->all();
            $newPost = new Post();

            $newPost->fill($postData);

            $newPost->slug = Post::convertToSlug($newPost->title);

            $newPost->save();
            return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        //$post=Post::find($id);
        if(!$post){
            abort(404);
        }
        $category = Category::find($post->category_id);
        return view('admin.posts.show', compact('post', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        if(!$post){
            abort(404);
        }

        $categories = Category::all();

        return view('admin.posts.edit', compact('post','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->validate([
            'title'=> 'required|max:250',
            'content'=> 'required',
            'category_id'=>'required|exists:categories,id'
        ],
        [
            'title.required'=>'Il titolo dev\'essere valorizzato',
            'title.max'=>'Hai superato i 250 caratteri',
            'content.min'=>':attribute deve avere almeno :min caratteri',
            'category_id.exists'=> 'La categoria selezionata non esiste'
        ]);


        $postData = $request->all();
        $post->fill($postData);
        $post->slug= Post::convertToSlug($post->title);

        $post->update();

        return redirect()->route('admin.posts.index', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        if($post){
            $post->delete();
        }
        //$post = Post::findOrFail($id);
        return redirect()->route('admin.posts.index');
    }
}
