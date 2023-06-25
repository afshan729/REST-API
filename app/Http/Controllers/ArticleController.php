<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'content' => 'required',
            'author' => 'required',
            'category' => 'required',
            'published_at' => 'required|date',
        ]);

        $article = Article::create($request->only(['title', 'content', 'author', 'category', 'published_at']));

        return response()->json($article, 201);
    }

    public function index()
    {
        $articles = Article::orderBy('id', 'asc')->get();

        return response()->json($articles, 200);
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json('Article not found', 404);
        }

        return response()->json($article, 200);
    }

    public function destroy($id)
{
    $article = Article::find($id);

    if (!$article) {
        return response()->json('Article not found', 404);
    }

    $article->delete();

    return response()->json('Article deleted successfully', 200);
}

}
