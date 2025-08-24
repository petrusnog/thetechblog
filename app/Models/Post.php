<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    private const POSTS_PER_PAGE = 10;
    private static array $statuses = [
        'draft',
        'published'
    ];
    private static array $orderable_columns = [
        'title',
        'body'
    ];
    private static array $order_directions = [
        'asc',
        'desc'
    ];

    /**
     * The valid statuses for the post.
     */
    public static function getStatuses()
    {
        return self::$statuses;
    }

    /**
     * The posts per page limit in the application.
     */
    public static function getPostsPerPage()
    {
        return self::POSTS_PER_PAGE;
    }

    /**
     * The posts' orderable / searchable columns.
     */
    public static function getSearchableColumns()
    {
        return self::$orderable_columns;
    }

    /**
     * The valid order directions for a post (ASCENDING, DESCENDING).
     */
    public static function getOrderDirections()
    {
        return self::$order_directions;
    }
}
