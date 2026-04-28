<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 't_article';
    protected $primaryKey = 'id_art';  // Définir une clé primaire personnalisée
    public $incrementing = true;  // Si votre clé primaire est un entier auto-incrémenté
    protected $keyType = 'int';  // Spécifiez le type de clé s'il s'agit d'un entier
    
    protected $fillable = ['ident_art', 'date_art', 'readtime_art', 'title_art', 'hook_art','url_art','fk_category_art','content_art', 'image_art'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_category_art', 'id_cat');
    }
}
