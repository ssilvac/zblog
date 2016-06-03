<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Post;
use App\TipoPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller {

	public function index() {

		$posts = Post::orderBy('updated_at', 'desc')->paginate(7);

		return view('admin/posts', compact('posts'));
	}

	public function create(){

		$tipos = TipoPost::all();
		return view('publish')->with('tipos', $tipos);
	}

	public function edit($id) {

		//Auth::loginUsingId(1);

		$post = Post::findOrFail($id);

		if (Gate::denies('update', $post)) {
			//Alert::danger('No tienes permisos para editar este post');
			return redirect('posts');
		}
		return $post->title;

	}

	public function listapublica()
	{

		$posts = Post::orderBy('updated_at', 'desc')->paginate(10);
		$tipos = TipoPost::all();

		return view('posts')->with('posts', $posts)
							->with('tipos', $tipos);
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
		$post->save();

		return redirect('publish/create')
			->with('alert', 'Tu publicación ha sido guardada');

	}
}