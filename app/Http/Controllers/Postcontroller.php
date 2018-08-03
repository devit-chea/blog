<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Response;
use App\Post;
use Validator;
use Illuminate\Support\Facades\Input;

class Postcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index');
        
        
    }
    public function about()
    {
        return view('pages.about');
    }
    public function post()
    {
        //$posts = Post::all();
        //return Post::where('title' , 'Post One')->get();
        //$posts = DB::select('SELECT * FROM posts')
        //$posts = Post::orderBy('title' , 'desc')->get();
        // $posts = Post::orderBy('title' , 'desc')->take(1)->get();
        // return view('pages.post')->with('posts', $posts);
        //$posts = Post::orderBy('title' , 'desc')->get();
        $posts = Post::orderBy('title' , 'desc')->paginate(5);
        return view('pages.post')->with('posts', $posts);
    }
    public function postIterm()
    {
        $posts = Post::all();
        return view('pages.postIterm')->with('posts', $posts);
    }
    public function getPost(){
        $posts = Post::all();
        $data['posts'] = $posts;
        return Response::json($data);
    }
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|unique:posts|max:255',
            'body' => 'required',
        ]);
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return Response::json($post);   
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postid = Post::find($id);
        return view('pages.edite')->with('post' , $postid);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function edit($id) {
        $post = Post::find($id);
        $data['post'] = $post;
        return Response::json($data);
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
        $post = Post::find($request->id);
        $post->title=$request->title;
        $post->body=$request->body;
        $post->save();
    }


    public function addPost(Request $req)
    {
        $rules = array(
            'title' => 'required',
            'body' => 'required',
        );
        $validator = Validator::make(input::all(),$rules);
        if($validator->fails()){
            return response::json(array('error'->$validator->getMessageBag()->toarray()));

        }else{
            $post = new Post;
            $post->title = $req->title;
            $post->body = $req->body;
            $post->save();
            return response()->json($post);

        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['post'] = $id;
        $post = Post::find($id);
        $post->delete();
        return Response::json($data);
    }

    
    // public function index(Request $req)
    // {
    //     $data = Post::all();
    //     return view('pages.index')->withData($data);
    // }

    // public function addItem(Request $request)
    // {
    //     $rules = array(
    //             'title' => 'required|alpha_num',
    //     );
    //     $validator = Validator::make(Input::all(), $rules);
    //     if ($validator->fails()) {
    //         return Response::json(array(

    //                 'errors' => $validator->getMessageBag()->toArray(),
    //         ));
    //     } else {
    //         $data = new Post();
    //         $data->title = $request->title;
    //         $data->save();

    //         return response()->json($data);
    //     }
    // }
 
    // public function editItem(Request $req)
    // {
    //     $data = Post::find($req->id);
    //     $data->title = $req->title;
    //     $data->body = $req->body;
    //     $data->save();

    //     return response()->json($data);
    // }
    // public function deleteItem(Request $req)
    // {
    //     Post::find($req->id)->delete();

    //     return response()->json();
    // }
}
