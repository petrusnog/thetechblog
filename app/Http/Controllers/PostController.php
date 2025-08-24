<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $order = $request->input('order') ?? 'asc';
        $orderBy = $request->input('orderBy') ?? 'title';

        $posts = Post::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'ILIKE', "%{$search}%")
                    ->orwhere('body', 'ILIKE', "%{$search}%");
            })
            ->when($orderBy, function ($query, $orderBy) use ($request) {
                $order = $request->input('order') ?? 'asc';
                $query->orderBy($orderBy, $order);
            })
            ->paginate(Post::getPostsPerPage())
            ->appends(request()->query());

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'posts_per_page' => Post::getPostsPerPage(),
            'total' => $posts->total(),
            'orderableColumns' => Post::$orderable,
            'filters' => [
                'search' => $search,
                'order' => $order,
                'orderBy' => $orderBy
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posts/Create', [
            'status' => Post::getStatuses()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = 200;
        $message = "Post created successfully!";

        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'title' => 'required|string|max:255',
                'body' => 'required|string|min:20',
                'status' => 'required|in:' . implode(',', Post::getStatuses())
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $post = new Post();
            $post->title = $data['title'];
            $post->body = $data['body'];
            $post->status = $data['status'];
            $now = new \Datetime('now', new \DateTimeZone('UTC'));
            $post->published_at = $now->format('Y-m-d H:i:s');

            $post->save();

        } catch (\Exception $e) {
            $status = 400;
            $message = $e->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ], $status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/Single', [
            'post' => new PostResource($post)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
