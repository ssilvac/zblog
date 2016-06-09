<?php

namespace App\Http\Controllers;

use Gate;
use Mail;
use Response;
use App\Http\Controllers\Controller;
use App\Post;
use App\TipoPost;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;

class PostController extends Controller {

	private $ruta = 'app/imgPost';


	public function index(Request $request) {

		$posts = Post::type($request->get('slc_tipo'))->orderBy('id', 'desc')->paginate(7);
		$tipos = TipoPost::all();

		return view('admin/posts')->with('posts', $posts)
									->with('tipos', $tipos);
	}

	public function create(){

		$tipos = TipoPost::all();
		return view('publish')->with('tipos', $tipos);
	}

	public function show($id) {

		//Auth::loginUsingId(1);

		$post = Post::findOrFail($id);
		$tipos = TipoPost::all();

		if (Gate::denies('update', $post)) {
			Alert::danger('No tienes permisos para editar este post');
			return redirect('posts');
		}

		return view('admin.post.edit')->with('post', $post)
									->with('tipos', $tipos);
	}

	public function edit($id) {

		//Auth::loginUsingId(1);

		$post = Post::findOrFail($id);
		$tipos = TipoPost::all();

		if (Gate::denies('update', $post)) {
			Alert::danger('No tienes permisos para editar este post');
			return redirect('posts');
		}

		return view('admin.post.edit')->with('post', $post)
									->with('tipos', $tipos);
	}

	public function delete($id) {

		$post = Post::find($id);

		if($post->delete()){
			return Response::json($post);
		}
	}

	public function listapublica(Request $request)
	{

		$posts = Post::type($request->get('slc_tipo'))->orderBy('updated_at', 'desc')->paginate(10);
		$tipos = TipoPost::all();

		return view('posts')->with('posts', $posts)
							->with('tipos', $tipos);
	}


	public function update(Request $request)
	{
		dd($request);
	}

	public function store(Request $request)
	{

		$user = $request->user();

		$this->validate($request, [
			'title' 			=> 'required',
			'description' 		=> 'required|string',
			'tipo_id' 			=> 'required|int'
		]);

				
		$post = new Post();
		$post->title = $request->get('title');
		$post->description = $request->get('description');
		$post->user_id = $user->id;
		$post->tipo_id = $request->get('tipo_id');

		if($file = $request->file('imagen'))
		{
			$nombre = $file->getClientOriginalName();
			$request->file('imagen')->move(public_path($this->ruta), $nombre);

			$post->imagen = $this->ruta."/".$nombre;

			$post->save();
		}
		
	
		return redirect('admin.post');
	}

	/**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
	public function sendEmailReminder(Request $request, $id)
	{
		$post = Post::findOrFail($id);

        Mail::send('emails.reminder', ['post' => $post], function ($m) use ($post)
        {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
	}
}