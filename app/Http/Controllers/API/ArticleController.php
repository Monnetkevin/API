<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with(['user', 'images'])->get();
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'article_name' => 'required|string|max:50',
            'article_content' => 'required',
        ]);

        $article = Article::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));

        return response()->json([
            'message' => 'Article créé avec succès',
            'data' => $article
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'article_name' => 'required|string|max:50',
            'article_content' => 'required',
        ]);

        $article->update($request->all());

        return response()->json([
            'message' => 'Mise à jour réussite !!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            'message' => 'Super, tu as supprimé l\'article !'
        ]);
    }
}
