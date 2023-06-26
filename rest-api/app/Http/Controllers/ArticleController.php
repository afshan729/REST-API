<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ArticleCollection(Article::orderBy('id', 'asc')->get());
    }

    public function store(Request $request)
    {
        
        $article = Article::create($request->validated());

        return new ArticleResource($article);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    public function destroy($article)
    {
        $data = Article::find($article);
    
        if ($data) {
            $data->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Article not found'], 404);
        }
    }
    
}
