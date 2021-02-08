<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return self::get("user.posts.index", true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->get("title");
        $post->description = $request->get("description");
        $post->publicated_at = $request->get("publication_date");
        $post->user_id = auth()->user()->id;

        $post->save();

        return redirect()->route("posts.index")->with("success", __("posts.create.success"));
    }

    public static function get(String $view, bool $userPosts = false): View
    {
        $request = request();

        $sortBy = "desc";

        if ($request->has("sort") && $request->get("sort") == "oldest") {
            $sortBy = "asc";
        }

        $posts = self::getPosts($userPosts, $sortBy);

        if ($sortBy == "asc") {
            $posts->appends(['sort' => "oldest"]);
        }

        $postView = $userPosts ? "admin-post" : "home-post";

        return view($view, compact("posts", "sortBy", "postView"));
    }

    private static function getPosts(bool $userPosts, String $sortBy): LengthAwarePaginator
    {
        $limit = env("POSTS_PER_PAGE");
        $posts = null;

        if ($userPosts) {
            $posts = auth()->user()->posts();
        } else {
            $posts = Post::with("user")->where("publicated_at", "<=", date("Y-m-d H:i:s"));
        }

        return $posts->orderBy("id", $sortBy)->paginate($limit);
    }
}
