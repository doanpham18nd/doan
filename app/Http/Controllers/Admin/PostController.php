<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChatEvent;
use App\Message;
use Illuminate\Http\Request;

class PostController extends Controller {

	public function index(Request $request, Message $post) {
		$allPosts = $post->whereIn('user_id', $request->user()->following()->pluck('users.id')->push($request->user()->id))->with('user');

		$posts = $allPosts->orderBy('created_at', 'desc')->take(10)->get();

		return response()->json([
			'posts' => $posts,
		]);
	}

	public function create(Request $request, Message $post) {
		// create post
		$createdPost = $request->user()->posts()->create([
			'body' => $request->body,
		]);
		// broadcast
		broadcast(new ChatEvent($createdPost, $request->user()))->toOthers();
		// return the response
		return response()->json($post->with('user')->find($createdPost->id));
	}
}
