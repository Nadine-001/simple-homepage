<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home = Home::all()->first();

        return view('home', [
            'name' => $home->name,
            'description' => $home->description,
            'logo' => Storage::url($home->logo),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create', [
            'name' => 'Create A Homepage'
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
        // Get the data from the request
        $name = $request->input('name');
        $description = $request->input('description');

        // Create a new Home and put the requested data to the corresponding column
        $home = new Home;
        $home->name = $name;
        $home->description = $description;

        // Dealing with image
        $logo_path = $request->file('logo')->store('logos', 'public');
        $home->logo = $logo_path;

        // Save the data
        $home->save();

        $home = Home::all()->first();

        return view('success', [
            'name' => $home->name,
            'description' => $home->description,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //get the posts that are published, sort by decreasing order of "id".
        $posts = Post::where('is_published', true)->orderBy('id', 'desc')->paginate(1);

        //get all the categories
        $categories = Category::all();

        //get all the tags
        $tags = Tag::all();

        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
