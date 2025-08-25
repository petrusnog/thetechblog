<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $search = $data['search'] ?? "";
        $searchBy = $data['searchBy'] ?? 'title';
        $order = $data['order'] ?? 'asc';
        $orderBy = $data['orderBy'] ?? 'title';

        if (!in_array($searchBy, Post::getSearchableColumns())) {
            $searchBy = 'title';
        }
        if (!in_array($order, Post::getOrderDirections())) {
            $order = 'asc';
        }
        if (!in_array($orderBy, Post::getSearchableColumns())) {
            $orderBy = 'title';
        }

        $posts = Post::query()
            ->when($search, function ($query, $search) use ($searchBy) {
                $query->where($searchBy, 'ILIKE', "%{$search}%");
            })
            ->when($orderBy, function ($query, $orderBy) use ($order) {
                $query->orderBy($orderBy, $order);
            })
            ->paginate(Post::getPostsPerPage())
            ->appends(request()->query());

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'posts_per_page' => Post::getPostsPerPage(),
            'total' => $posts->total(),
            'orderableColumns' => Post::getSearchableColumns(),
            'filters' => [
                'search' => $search,
                'searchBy' => $searchBy,
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
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('posts', 'title')
                ],
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
