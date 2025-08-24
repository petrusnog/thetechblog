<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';

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
}
