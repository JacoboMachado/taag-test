<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publication',
        'category_id',
        'author_id'
    ];
    
    public $timestamps = false;

    /**
     * todas las relaciones
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function onShelves()
    {
        return $this->hasMany(BookOnShelf::class);
    }

    /**
     * Devuelve subconsulta con libros que tienen ejemplares disponibles para prestamo
     */
    public function scopeAvailablesToLoan($query)
    {
        return $query->whereHas('onShelves', function($q) {
            $q  ->whereDoesntHave('loans')
                ->orWhereHas('loans', function($qu){
                    $qu->whereNotNull('return_date');
                });
            });
    }

    /**
     * Devuelve subconsulta que busca libros por el titulo o el nombre de su Autor
     */
    public function scopeSearchByTitleOrAuthor($query, $search)
    {
        return $query->where('title', 'LIKE', "%$search%")
            ->orWhere(function($query) use ($search){
                $query->whereHas('author', function($q) use($search){
                    $q->where('name', 'LIKE', "%$search%");
                });
            });
    }

    /**
     * Devuelve subconsulta con libros y su relacion de ejemplares que no estan en prestamo con 
     */
    public function scopeAvailablesToLoanWithRelations($query)
    {
        return $query->with(['onShelves' => function($q) {
            $q  ->whereDoesntHave('loans')
                ->orWhereHas('loans', function($qu){
                    $qu->whereNotNull('return_date');
                })
                ->with('loans', 'shelve');
        }]);
    } 

    /**
     * Guarda la edicion de un Libro respetando la convencion de nombres del frontend
     */
    public function editWithInput(array $data)
    {
        $this->title = $data['titulo'];
        $this->author_id = $data['autor'];
        $this->category_id = $data['categoria'];
        $this->publication = $data['publicacion'];
        return $this->save();
    }

    /**
     * recibe un objeto Book con sus relaciones
     * devuelve bool como comprobacion de que dicho modelo tiene prestamos activos
     */
    public function hasActiveLoans()
    {
        $flag = false;
        foreach($this->onShelves as $onShelve){
            foreach($onShelve->loans as $loan){
                if(!isset($loan->return_date)) $flag = true;
            }
        }
        return $flag;
    }

    /**
     * agrega status de los ejemplares (accesible desde ->loan)
     * 
     */
    public function addLoansStatus()
    {
        foreach($this->onShelves as $onShelve){
            $onShelve->isLoan();
        }
        return $this;
    }

}
