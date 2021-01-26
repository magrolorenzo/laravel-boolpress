<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) {
            $new_post = new Post();
            $new_post->author = $faker->name();
            $new_post->title = $faker->sentence();

            // Creo Slug a partire dal titolo
            $slug_base = Str::slug($new_post->title);
            $slug = $slug_base;
            // Salvo il primo risultato della collection ritornata dalla query
            $existing_post = Post::where("slug",$slug_base)->first();
            $contatore = 1;

            while($existing_post){
                $slug = $slug_base . "-" . $contatore;
                $contatore++;
                $existing_post = Post::where("slug",$slug_base)->first();
            }

            $new_post->slug = $slug;

            $new_post->body = $faker->paragraphs(3,true);
            $new_post->date = $faker->dateTime();
            $new_post->save();
        }
    }
}
