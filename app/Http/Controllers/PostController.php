<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\PostResource;

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
                $order = $request->input('order');
                $query->orderBy($orderBy, $order);
            })
            ->paginate(10)
            ->appends(request()->query());

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
