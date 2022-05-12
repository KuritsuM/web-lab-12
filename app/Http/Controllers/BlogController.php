<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        return redirect()->route('blog', ['id' => 1]);
    }

    public function blogMain($pageNumber) {
        $blogPosts = (new BlogPost())->getPaginatedPosts($pageNumber);
        $maximumPage = (new BlogPost())->getMaximumPages();

        return view('blog', [ 'blogPosts' => $blogPosts, 'maxPage' => $maximumPage,
            'nextPage' => $pageNumber + 1, 'previousPage' => $pageNumber - 1 ]);
    }

    public function createPost(Request $request) {
        $request->validate([
            'theme' => ['required', 'max:255'],
            'post_text' => ['required'],
        ]);

        (new BlogPost($request))->save();
        return redirect()->route('blog', ['id' => 1]);
    }

    public function deletePost($id) {
        BlogPost::find($id)->delete();

        return redirect()->route('blog', ['id' => 1]);
    }

    public function updatePost(Request $request) {
        $request->validate([
            'theme' => ['required', 'max:255'],
            'post_text' => ['required'],
        ]);

        $blogPost = BlogPost::find((int)$request->input('id'));
        $blogPost->updatePost($request);
        $blogPost->save();

        return redirect()->route('blog', ['id' => 1]);
    }
}
