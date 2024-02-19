<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // $articles = DB::table('articles')
        //     ->select('articles.*', 'users.name', 'images.image_name')
        //     ->groupBy('image_name')
        //     ->leftJoin('users', 'users.id', '=', 'articles.user_id')
        //     ->leftJoin('images', 'images.article_id', '=', 'articles.id')
        //     ->get();

        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role_id == 2) {

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
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }

    public function random()
    {
        $random = DB::table('articles')
            ->inRandomOrder()
            ->leftJoin('images', 'images.article_id', '=', 'articles.id')
            ->limit(4)
            ->get();
        return response()->json($random);
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
            'message' => 'Mise à jour réussite !!',
            'data' => $article,
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
