<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class FavoriteAjaxController extends Controller
{
    // Récupérer les favoris stockés en session
    private function getFavorites()
    {
        if (!isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = [];
        }

        // On filtre les valeurs vides
        $_SESSION['favorites'] = array_filter($_SESSION['favorites']);

        return $_SESSION['favorites'];
    }

    // Récupérer les articles favoris depuis la base de données
    private function getArticlesFromFavorites($articleIds)
    {
        // Vérifier que les IDs ne sont pas vides
        $articleIds = array_filter($articleIds, function ($id) {
            return !empty($id); // Éliminer les valeurs nulles ou vides
        });

        if (empty($articleIds)) {
            return collect(); // Si aucun article valide, retourner une collection vide
        }

        // Utilisation de la méthode `whereIn` pour récupérer les articles favoris
        return Article::whereIn('id_art', $articleIds)->get();
    }

    // Récupérer la liste des favoris
    public function index()
    {
        session_start();
        $favorites = $this->getFavorites();
        $articles = $this->getArticlesFromFavorites($favorites);

        return response()->json([
            'favorites' => $articles->map(function ($article) {
                return [
                    'id' => $article->id_art, 
                    'title' => $article->title_art
                ];
            })->toArray(),
            'count' => count($favorites)
        ]);
    }

    public function add(Request $request, $articleId = null)
    {
        session_start();

        // Vérifie si l'ID est passé en URL ou dans le POST
        $id = $articleId ?? $request->input('articleId');

        if (empty($id)) {
            return response()->json(['error' => 'ID manquant'], 400);
        }

        // Récupérer les favoris existants
        $favorites = $this->getFavorites();

        // Si l'ID n'est pas déjà dans les favoris, l'ajouter
        if (!in_array($id, $favorites)) {
            $favorites[] = $id;
        }

        // Utiliser array_filter pour enlever les valeurs nulles ou vides dans le tableau
        $_SESSION['favorites'] = array_values(array_filter($favorites)); // Retirer les valeurs vides

        // Récupérer les articles à partir des favoris
        $articles = $this->getArticlesFromFavorites($_SESSION['favorites']);
        return response()->json([
            'favorites' => $articles->pluck('title_art'),
            'count' => count($_SESSION['favorites']),
            'message' => '✅ Article ajouté aux favoris'
        ]);
    }

    // Supprimer un article des favoris
    public function remove(Request $request, $articleId)
    {
        session_start();
    
        // Check if the articleId is passed correctly
        $id = $articleId;  // Use $articleId directly from the route parameter
    
        // Retrieve the list of favorite articles from the session
        $favorites = $_SESSION['favorites'] ?? [];  // Ensure a default empty array if no favorites
    
        // Check if the article is in the favorites list and remove it
        if (($key = array_search($id, $favorites)) !== false) {
            unset($favorites[$key]);  // Remove the article from favorites
            $_SESSION['favorites'] = array_values($favorites);  // Re-index the array and save it back to session
        }
    
        // Retrieve the updated list of articles from favorites
        $articles = $this->getArticlesFromFavorites($favorites);  // Assuming this fetches articles based on the IDs in favorites
    
        // Return the updated list of favorites with the count and a message
        return response()->json([
            'favorites' => $articles->pluck('title_art')->toArray(),  // Titles of remaining favorite articles
            'count' => count($favorites),  // Updated count of favorites
            'message' => 'Article supprimé des favoris'  // Success message
        ]);
    }

    // Vider tous les favoris
    public function clear()
    {
        session_start();
        unset($_SESSION['favorites']);

        return response()->json([
            'favorites' => [],
            'count' => 0,
            'message' => 'Tous les favoris ont été supprimés'
        ]);
    }
}
?>