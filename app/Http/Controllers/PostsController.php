<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Posts;
use Auth;
class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Posts";

        $posts = Posts::where('status','!=',9)->get();
        
        return view('posts',compact('page_title','posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Add Posts";

        return view('adds.addpost',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $validatearray = [
            'name' => 'required'
        ];

        if ($request->postimage) {
        //Append validation
            $validatearray['postimage'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $request->validate($validatearray);

        //Generate Slug
        $slug = str()->slug($request->name."-".time());

        //Create Post
        $post = new Posts;
        $post->name = $request->name;
        $post->user_id = Auth::user()->id;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->status = 1;
        
        if($request->file('postimage')){
            $path = $request->file('postimage')->getRealPath();
            $image = file_get_contents($path);
            $postimage = base64_encode($image);
            $post->image = $postimage;
        }
        $post->save();

        return redirect()->route('posts.all')->with('msg','Succesully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data = Posts::where('slug',$slug)->where('status','!=',9)->first();

        if($data){
            $page_title = $data->name." View";
            return view('details.viewpost',compact('data','page_title'));
        }
        else{
            return redirect()->back()->with('msg','Post not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = Posts::where('slug',$slug)->where('status','!=',9)->first();

        if($data){
            $page_title = $data->name." Edit";
            return view('edits.editpost',compact('data','page_title'));
        }
        else{
            return redirect()->back()->with('msg','Post not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $thispost = Posts::where('slug',$slug)->where('status','!=',9)->first();

        if(!$thispost){
            return redirect()->back()->with('msg','Post not found');
        }
        else{
        //Validation
        $validatearray = [
            'name' => 'required'
        ];

        if ($request->postimage) {
        //Append validation
            $validatearray['postimage'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $request->validate($validatearray);

        //Generate Slug
        if($request->name != $thispost->name){
           $slug = str()->slug($request->name."-".time());  
        }
        else{
             $slug = $thispost->slug;
        }

        //Image
        if($request->file('postimage')){
            $path = $request->file('postimage')->getRealPath();
            $image = file_get_contents($path);
            $postimage = base64_encode($image);
        }
        else{
            $postimage = $thispost->image;
        }

        //Update
        $thispost->update([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $postimage
        ]);

        return redirect()->route('posts.edit',$thispost->slug)->with('msg','Post updated');

        }
    }

    public function publish($slug){
        $post = Posts::where('slug',$slug)->where('status','!=',9)->first();

        if($post){
            $post->update(['status' => 1]);
            return redirect()->back()->with('msg','Post succesully activated');
        }
        else{
            return redirect()->back()->with('msg','Post not found');
        }

    }

    public function unpublish($slug){
        $post = Posts::where('slug',$slug)->where('status','!=',9)->first();

        if($post){
            $post->update(['status' => 0]);
            return redirect()->back()->with('msg','Post succesully deactivated');
        }
        else{
            return redirect()->back()->with('msg','Post not found');
        }
    }
    public function deleteimage($slug){
        $post = Posts::where('slug',$slug)->where('status','!=',9)->first();

        if($post){
            $post->update(['image' => NULL]);
            return redirect()->route('posts.edit',$post->slug)->with('msg','Post Image Deleted');
        }
        else{
            return redirect()->back()->with('msg','Post not found');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Posts::where('slug',$slug)->where('status','!=',9)->first();

        if($post){
            $post->update(['status' => 9]);
            return redirect()->back()->with('msg','Post succesully deleted');
        }
        else{
            return redirect()->back()->with('msg','Post not found');
        }
    }
}
