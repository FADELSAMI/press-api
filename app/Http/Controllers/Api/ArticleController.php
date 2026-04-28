<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\FavoriteAjaxController;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;


class ArticleController extends Controller
{
    public function index()
    {
        //  récupérer les articles de cette catégorie
        $articles = Article::whereHas('category', function($query) {
            $query->where('name_cat', "on n'est pas des pigeons");
            })
            ->with('category')
            ->limit(10)  // Limiter à 10 articles
            ->get();

        return response()->json($articles);
    }

    public function show($id)
    {
        session_start();
        $config =  require_once 'C:\xampp\htdocs\press-api\config\mod.php';

        $article = Article::with('category')->findOrFail($id);

        if($config)
        {
            if (!isset($_SESSION['favorites'])) {
                $_SESSION['favorites'] = [];
            }
    
            // On filtre les valeurs vides
            $_SESSION['favorites'] = array_filter($_SESSION['favorites']);
            // Vérifier si l'article est dans les favoris
            $isFavorite = in_array($id, $_SESSION['favorites']);
        } else
        {
            $favorites = $this->getFavoritesFromCookie(); // Récupérer les favoris depuis le fichier
            // Vérifier si l'article est dans les favoris
            $isFavorite = in_array($id, $favorites);
        }

        
        // Retourner une réponse JSON
        return response()->json([
            'article' => $article,
            'isFavorite' => $isFavorite,
        ]);
    }
    public function showFavorites()
    {
        // Récupérer les IDs des articles favoris depuis le fichier
        $favorites = $this->getFavoritesFromCookie();

        // Récupérer les articles favoris dans la base de données
        $articles = Article::whereIn('id_art', $favorites)->get();

        return response()->json($articles);
    }
    
    public function addFavorite(Request $request, $id)
    {
        $favorites = $this->getFavoritesFromCookie();
    
        if (!in_array($id, $favorites)) {
            $favorites[] = $id;
    
            // Save favorites and attach the cookie
            return $this->saveFavoritesToCookie($favorites)
                ->setStatusCode(200)
                ->setContent(['message' => 'Article ajouté aux favoris']);
        }
    
        return response()->json(['message' => 'Article déjà dans les favoris'], 400);
    }
    private function saveFavoritesToCookie($favorites)
    {
        $favoritesJson = json_encode($favorites, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    
        if ($favoritesJson === false) {
            throw new \Exception("Failed to encode favorites to JSON: " . json_last_error_msg());
        }
    
        // Attach the cookie to the response
        return response()->noContent()
            ->cookie('favorites', $favoritesJson, 60 * 24 * 30); // Cookie valid for 30 days
    }
    

    // Fonction pour récupérer les favoris depuis un cookie
    private function getFavoritesFromCookie()
    {
        // Récupérer le contenu du cookie
        $favoritesJson = request()->cookie('favorites');

        // Convertir le JSON en tableau, ou retourner un tableau vide si le cookie n'existe pas
        return $favoritesJson ? json_decode($favoritesJson, true) : [];
    }

    // Fonction pour retirer un article des favoris
    public function removeFavorite(Request $request, $id)
    {
        // Récupérer les favoris depuis le cookie
        $favorites = $this->getFavoritesFromCookie();

        // Retirer l'article des favoris
        $favorites = array_filter($favorites, function ($favoriteId) use ($id) {
            return $favoriteId != $id;
        });

        // Sauvegarder les favoris modifiés dans le cookie
        $this->saveFavoritesToCookie($favorites);

        return response()->json(['message' => 'Article retiré des favoris']);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id');
        $readTimeMin = $request->input('readmin');  // Temps de lecture minimum
        $readTimeMax = $request->input('readmax');  // Temps de lecture maximum
        $articles = collect(); // Liste vide par défaut

        // Requête de recherche
        $query = Article::query();

        // Recherche par mot-clé dans le titre, le "hook" ou le contenu
        if ($keyword) {
            $query->where('title_art', 'LIKE', "%$keyword%")
                ->orWhere('hook_art', 'LIKE', "%$keyword%")
                ->orWhere('content_art', 'LIKE', "%$keyword%");
        }

        // Filtrage par catégorie
        if ($categoryId) {
            $query->where('fk_category_art', $categoryId);
        }

        // Filtrage par temps de lecture (min et max)
        if ($readTimeMin) {
            $query->where('readtime_art', '>=', $readTimeMin);  // Articles avec temps de lecture supérieur ou égal
        }

        if ($readTimeMax) {
            $query->where('readtime_art', '<=', $readTimeMax);  // Articles avec temps de lecture inférieur ou égal
        }

        // Limite des résultats
        $articles = $query->with('category')
                        ->get();

        // Retourner la réponse JSON
        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    public function readTime(Request $request)
    {
        $article = Article::all();
        return response()->json($article);
    }

}