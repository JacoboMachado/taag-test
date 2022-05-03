<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_on_shelve_id',
        'user_id',
        'loan_date',
        'return_date',
    ];

    protected $casts = [
        'loan_date' => 'datetime',
        'return_date' => 'datetime',
    ];
    

    public $timestamps = false;

    /**
     * relaciones
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'book_on_shelve_id');
    }

    public function onShelve()
    {
        return $this->belongsTo(BookOnShelf::class, 'book_on_shelve_id');
    }


    /**
     * Devuelve subconsulta todos prestamos con sus relaciones, realizado a un usuario($user_id) y ordenado del mas nuevo al mas antiguo
     */
    public function scopeLoanHistory($query, $user_id)
    {
        return $query->where('user_id', $user_id)
            ->with('onShelve.book.author', 'onShelve.book.category')
            ->orderBy('loan_date', 'DESC');
    }

    /**
     * Devuelve subconsulta prestamos no devueltos con sus relaciones, realizado a un usuario($user_id)
     */
    public function scopeGetLoansNotReturnedWithRelations($query, $user_id)
    {
        return $query->whereNull('return_date')
            ->where('user_id', $user_id)
            ->with('onShelve.book.author', 'onShelve.shelve');
    }

    /**
     * Devuelve un ejemplar de un libro 
     */
    public function returnNow()
    {
        $this->return_date = Carbon::now();
        return $this->save();
    }

    /**
     * mutators para devolver la fecha formateada a las vistas
     */
    public function getFormatedReturnDateAttribute()
    {
        return $this->return_date->format('d-m-Y');
    }

    public function getFormatedLoanDateAttribute()
    {
        return $this->loan_date->format('d-m-Y');

    }

}
