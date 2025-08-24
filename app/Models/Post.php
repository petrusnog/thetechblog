<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    private const STATUS_DRAFT = 'draft';
    private const STATUS_PUBLISHED = 'published';
    private const POSTS_PER_PAGE = 10;

    public static array $orderable = [
        'title',
        'body'
    ];

    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_PUBLISHED
        ];
    }

    public static function getPostsPerPage()
    {
        return self::POSTS_PER_PAGE;
    }
}
