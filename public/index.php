<?php

use Hillel\Models\Category;
use Hillel\Models\Post;
use Hillel\Models\Tag;

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';

// Categories
$categories = [];
for ($i = 1; $i <= 5; $i++) {
    $categories[] =
        [
            'title' => 'Category' . ' ' . $i,
            'slug' => 'c-' . $i
        ];
}

foreach ($categories as $category) {
    Category::create($category);
}

$updateCategory = Category::all()->random();
$updateCategory->title = 'Category X';
$updateCategory->slug = 'c-x';
$updateCategory->save();

$deleteCategory = Category::all()->random()->delete();

//Posts
$posts = [];

$categories = Category::all();

for ($i = 1; $i <= 5; $i++) {
    $posts[] =
        [
            'title' => 'Post' . ' ' . $i,
            'slug' => 'p-' . $i,
            'body' => 'Body' . ' ' . $i,
            'category_id' => $categories->random()->id
        ];
}

foreach ($posts as $post) {
    Post::create($post);
}

$updatePost = Post::all()->random();
$updatePost->title = 'Post X';
$updatePost->slug = 'p-x';
$updatePost->body = 'Body X';
$updatePost->category_id = $categories->random()->id;
$updatePost->save();

$deletePost = Post::all()->random()->delete();

//Tags
$tags = [];

for ($i = 1; $i <= 5; $i++) {
    $tags[] =
        [
            'title' => 'Tag' . ' ' . $i,
            'slug' => 't-' . $i,
        ];
}

foreach ($tags as $tag) {
    Tag::create($tag);
}

$tags = Tag::all();
$posts = Post::all();

foreach ($posts as $post) {
    $tagsId = $tags->pluck('id')->random(3);
    $post->tags()->sync($tagsId);
}
