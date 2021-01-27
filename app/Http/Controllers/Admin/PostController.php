<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "posts" => Post::all()
        ];

        return view("admin.posts.index", $data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post",$post));
    }

    /**
     * Show the form for editing the spe    cified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("admin.posts.edit", compact("post",$post));
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
        // Mi salvo i campi inseriti nel formi prendendoli dalla Request
        $edit_fields = $request->all();
        // Verifico se il titolo è stato modificato

        if($edit_fields["title"] != $post->title){

            // se si, devo aggiornare pure lo slug
            $slug_base = Str::slug($edit_fields["title"]);
            $slug = $slug_base;
            // Salvo il primo risultato della collection ritornata dalla query
            $existing_post = Post::where("slug",$slug)->first();
            $contatore = 1;

            while($existing_post){
                $slug = $slug_base . "-" . $contatore;
                $contatore++;
                $existing_post = Post::where("slug",$slug)->first();
            }
            $edit_fields["slug"] = $slug;
        }

        $post->update($edit_fields);
        return redirect()->route('admin.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
