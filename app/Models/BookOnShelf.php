<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOnShelf extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'shelve_id',

    ];
    
    public $timestamps = false;

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function shelve() 
    {
        return $this->belongsTo(Shelve::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'book_on_shelve_id');
    }

    /**
     * agrega a la coleccion variable bool "loan" que indica si el ejemplar esta en calidad de prestamo
     */
    public function isLoan()
    {
        $this->loan = false;
        foreach($this->loans as $loan)
        {
            if(!isset($loan->return_date)) $this->loan = true;
        }

        return $this;
    }

}   
