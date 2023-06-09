<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Requests\Post\Put;
use App\Http\Requests\Post\Store;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //
    public $columns = [
        'id' => 'Id',
        'date' => 'Date',
        'title' => 'Title',
        'description' => 'Description',
        'type' => 'Type',
        'category_id' => 'Category',
    ];

    public function index()
    {
        $posts = Post::orderBy('created_at','DESC')->paginate(5);
        return inertia("Dashboard/Post/Index", compact('posts'));
    }

    // public function create()
    // {
    //     $categories = Category::get();
    //     return inertia("Dashboard/Post/Create", compact('categories'));
    // }

    public function create()
    {
        $categories = Category::get();
        return inertia("Dashboard/Post/Save", compact('categories'));
    }


    public function store(Store $request)
    {
       $post = Post::create($request->validated());
       $this->upload($request, $post);
        // $data['image'] = $filename = time() . "." . $request['image']->extension();
        // $request->image->move(public_path("image/post"), $filename);
        // $post->update($data);

        return to_route('post.index')->with('message', "Created post successfully");
    }


    // public function edit(Post $post)
    // {
    //     $categories = Category::get();
    //     return inertia("Dashboard/Post/Save", compact('post', 'categories'));
    // }
    
    public function edit(Post $post)
    {
        $categories = Category::get();
        return inertia("Dashboard/Post/Save", compact('post', 'categories'));
        // return inertia("Dashboard/Post/Edit", compact('post', 'categories'));
    }

    public function update(Put $request, Post $post)
    {
      if($post->image !=null && $request->image != null){
        $this->imageDelete($post);
        $post->update($request->validated());
        $this->upload($request, $post);
      }else{
        $post->update($request->validated());
        $this->upload($request, $post);
      }

        return redirect()->route('post.index')->with('message', "Updated post successfully");
    }

    public function destroy(Post $post)
    {
        Storage::disk("public_upload")->delete("image/post/" . $post->image);
        $post->delete();
        return to_route('post.index')->with('message', "Deleted post successfully");
    }

    public function upload(Request $request, Post $post)
    {
        // dd($request['image']);
        if($request->image != null){
            $request->validate(
                [
                    'image' => 'required|mimes:jpg,jpeg,png,gif|max:10240'
                ]
            );
            
            Storage::disk("public_upload")->delete("image/post/" . $post->image); //Primero eliminamos la imagen
            $data['image'] = $filename = time() . "." . $request['image']->extension();
            $request->image->move(public_path("image/post"), $filename);
            $post->update($data);
            return to_route('post.index')->with('message', "Upload image to post successfully");
        }
       
       
    }

    public function imageDelete(Post $post)
    {
        Storage::disk("public_upload")->delete("image/post/" . $post->image);
        $post->update(['image' => '']);
        return to_route('post.edit', $post->id)->with('message', "image removed to post successfully");
    }
}
