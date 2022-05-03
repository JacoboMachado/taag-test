<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Shelve;
use App\Models\Category;
use App\Models\BookOnShelf;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el buscador de libros para solicitar un prestamo
     *
     */
    public function bookAvailableSearcher()
    {
        $categories = Category::all();
        return view('loans.list', compact('categories'));

    }

    /**
     * Muestra el buscador de libros para solicitar un prestamo
     *
     */
    public function bookAvailableSearch(Request $request)
    {
        $request->validate([
            'searchBook' => ['nullable', 'string'],
            'category' => ['nullable', 'exists:categories,id']
        ]); 

        $available_books = Book::AvailablesToLoan();

        if($request->searchBook)
        {
            $available_books->SearchByTitleOrAuthor($request->searchBook);
        }

        if($request->category)
        {
            $available_books->where('category_id', $request->category);
        }

        $available_books = $available_books
            ->with(['author', 'category'])
            ->get();

        $categories = Category::all();
        $request = $request->all();
        return view('loans.list', compact('categories', 'available_books', 'request'));
    }

    /**
     * Crea nuevo prestamo
     */
    public function newLoan($book_id)
    {
        $book = Book::AvailablesToLoanWithRelations()->findOrFail($book_id);

        $to_lend = $book->onShelves->first();
        Loan::create([
            'book_on_shelve_id' => $to_lend->id,
            'user_id' => auth()->user()->id,
            'loan_date' => Carbon::now(),

        ]);

        $shelve = $to_lend->shelve->shelve;

        return redirect('home')->withSuccess("Te hemos prestado el libro $book->title, correctamente, lo puedes encontrar en el estante '$shelve', recuerda cuidar los libros que te prestamos :)");
        
    }

    /**
     * retorna vista con todos los ejemplares por devolver para el usuario autenticado
     */
    public function returnList()
    {
        $loans = Loan::GetLoansNotReturnedWithRelations(auth()->user()->id)->get();
        
        return view('loans.returnList', compact('loans'));
    }

    /**
     * Retorna un prestamo
     */
    public function newReturn($loan_id)
    {
        $loan = Loan::GetLoansNotReturnedWithRelations(auth()->user()->id)
            ->findOrFail($loan_id);

        $loan->returnNow();

        $shelve = $loan->onShelve->shelve->shelve;
        $title = $loan->onShelve->book->title;

        return redirect('home')->withSuccess("Has devuelto correctamente el libro $title, recuerda colocarlo en su lugar en el estante '$shelve'. ");
        

    }

    /**
     * Retorna el historial de prestamos del usuario autenticado
     */
    public function loanHistory()
    {
        $loans = Loan::loanHistory(auth()->user()->id)->get();
        
        return view('loans.history', compact('loans'));
    }

}
