<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id')->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();
        return view ('admin.posts.index', compact('posts', 'categories', 'tags'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $new_post = new Post();

        $data['slug'] = Post::generateSlug(($data['title']));

        $new_post->fill($data);
        $new_post->save();

        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact ('post'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact ('post', 'categories', 'tags'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();

        // inserendo un "if" nello slug, facciamo in modo che se facciamo un aggiornamento a un post, cambia anche lo slug e se mettiamo lo stesso titolo tra due post, non vanno in conflitto
        if($data['title'] != $post->title){
            $data['slug'] = Post::generateSlug(($data['title']));
        }

        $post->update($data);

        // se esiste l’array "tags" lo uso per sincronizzare i dati della tabella ponte
        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        // se non esiste vuol dire che devo cancellare tutte le relazioni eventualmente presenti
        }else{
            // con "detach" non gli passo nessuna informazione
            $post->tags()->detach();
        }


        return redirect()->route('admin.posts.show', $post);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $name_post = $post->title;
        $id_post = $post->id;
        $post->delete();
        return redirect()->route('admin.posts.index')->with('post_deleted', "Il post  N° $id_post $name_post è stato eliminato con successo");
    }

}
