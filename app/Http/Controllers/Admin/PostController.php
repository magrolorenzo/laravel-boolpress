<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all();
        $tags = Tag::all();

        $data =[
            "categories" => $categories,
            "tags" => $tags
        ];

        return view("admin.posts.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDAZIONE

        $request->validate([
            "title"=>"required|max:255",
            "author"=>"required|max:255",
            "date"=>"required",
            "body"=>"required",
            "category_id"=>"nullable|exists:categories,id",
            "tags"=>"exists:tags,id",
            "image_cover"=>"nullable| mimes:jpeg,jpg,png|max:512"
        ]);

        // Prendo le info scritte nel form
        $form_infos = $request->all();

        // dd($form_infos);

        // Controllo se è stata caricata l'immagine
        if(array_key_exists("image_cover", $form_infos)){
            // Salvo l img e recupero la path
            $cover_path = Storage::put("post_covers", $form_infos["image_cover"]);
            $form_infos["cover"] = $cover_path;
            // dd($form_infos);
        }

        // Creo un nuovo oggetto Post e lo compilo con le info
        $new_post = new Post;
        $new_post ->fill($form_infos);

        $slug_base = Str::slug($new_post->title);
        $slug = $slug_base;
        // Salvo il primo risultato della collection ritornata dalla query
        $existing_post = Post::where("slug",$slug)->first();
        $contatore = 1;

        while($existing_post){
            $slug = $slug_base . "-" . $contatore;
            $contatore++;
            $existing_post = Post::where("slug",$slug)->first();
        }
        $new_post->slug = $slug;

        $new_post->save();


        if($request->input("tags")){
            $new_post->tags()->sync($form_infos["tags"]);
        } else{
            $new_post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug",$slug)->first();

        if(!$post){
            abort(404);
        }

        $data=[
            "post" => $post
        ];
        return view("admin.posts.show", compact("post", $data));
    }

    /**
     * Show the form for editing the spe    cified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where("slug",$slug)->first();
        $tags = Tag::all();

        if(!$post){
            abort(404);
        }

        $categories = Category::all();

        $data=[
            "post" => $post,
            "categories" => $categories,
            "tags" => $tags
        ];
        return view("admin.posts.edit", $data);
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
        if(!$post){
            abort(404);
        }

        // dd($request->all());
        $request->validate([
            "title"=>"required|max:255",
            "author"=>"required|max:255",
            "date"=>"required",
            "body"=>"required",
            "category_id"=>"nullable|exists:categories,id",
            "tags"=>"exists:tags,id",
            "image_cover"=>"nullable| mimes:jpeg,jpg,png|max:512"
        ]);

        // Mi salvo i campi inseriti nel formi prendendoli dalla Request
        $edit_fields = $request->all();
        // Verifico se il titolo è stato modificato


        // Controllo se è stata caricata l'immagine
        if(array_key_exists("image_cover", $edit_fields)){
            // Salvo l img e recupero la path
            $cover_path = Storage::put("post_covers", $edit_fields["image_cover"]);
            $edit_fields["cover"] = $cover_path;
        }

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

        if($request->input("tags")){
            $post->tags()->sync($edit_fields["tags"]);
        } else{
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
