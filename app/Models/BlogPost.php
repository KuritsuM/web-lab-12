<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BlogPost extends Model
{
    use HasFactory;

    const POSTS_ON_PAGE = 5;

    /**
     * BlogPost constructor.
     */
    public function __construct(Request $request = null)
    {
        if (!is_null($request)) {
            $this->theme = $request->input('theme');
            $this->postText = $request->input('post_text');
        }
    }

    public function getPostsCount() {
        return BlogPost::where('id', '>', 0)->count();
    }

    public function getMaximumPages() {
        if ($this->getPostsCount() % self::POSTS_ON_PAGE > 0) {
            return (int)((int)$this->getPostsCount() / self::POSTS_ON_PAGE) + 1;
        }

        return (int)($this->getPostsCount() % self::POSTS_ON_PAGE / 5);
    }

    public function getPaginatedPosts($pageNumber) {
        return array_reverse(BlogPost::where('id', '>', $this->getPostsCount() - (self::POSTS_ON_PAGE * $pageNumber))
            ->take(self::POSTS_ON_PAGE)->get()->toArray());
    }

    public function updatePost(Request $request) {
        $this->theme = $request->input('theme');
        $this->postText = $request->input('post_text');
    }
}
