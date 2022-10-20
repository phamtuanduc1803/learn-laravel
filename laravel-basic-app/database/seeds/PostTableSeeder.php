<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=1;$i<10;$i++) {
            $post = new Post;
            $post->title = 'bai viet'.$i;
            $post->body = $faker->text;
            $post->user_id = $i % 3 + 1;
            $post->category_id = ($i+2) % 3 + 1;
            $post->num_like = rand(100,200);
            $post->num_view = rand(1000,2000);
            $post->num_comment = rand(50,100);
            $post->save();
        }
    }
}
