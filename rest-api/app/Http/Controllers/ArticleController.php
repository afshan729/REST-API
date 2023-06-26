<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('id', 'asc')->get();
        return new ArticleCollection($articles);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

   
}
