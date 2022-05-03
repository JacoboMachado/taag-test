<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Author;
use App\Models\Shelve;
use App\Models\Category;
use App\Models\BookOnShelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }


    /**
     * Constructor de validacion (sin ejecucion del validate) para crear/editar libros
     */
    protected function bookValidator(array $data)
    {
        $year = now()->year;
        return Validator::make($data, [
            'titulo' => ['required', 'string', 'max:190'],
            'autor'    => ['required', 'exists:authors,id'],
            'categoria'  => ['required', 'exists:categories,id'],
            'publicacion' => ['required ', 'numeric', "between:1900,$year"]
        ]);
    }

    /**
     * retorna vista con el listado de todos los libros
     */
    public function bookList()
    {
        $books = Book::with('author')->withCount('onShelves')->get();
        $authors = Author::all();
        $categories = Category::all();
        
        return view('settings.bookList', compact('books', 'authors', 'categories'));
    }

    /**
     *  Crea un nuevo libro
     */
    public function newBook(Request $request)
    {
        
        $this->bookValidator($request->all())->validate();

        Book::create([
            'title' => $request->titulo,
            'author_id' => $request->autor,
            'category_id' => $request->categoria,
            'publication' => $request->publicacion
        ]);

        return back()->withSuccess('Libro Creado correctamente, ahora puede agregar ejemplares en Administración->Ejemplares');
    }

    /**
     * Retorna vista para editar un libro
     */
    public function editBook($book_id)
    {
        $book = Book::with('author', 'category')->findOrFail($book_id);
        $categories = Category::all();
        $authors = Author::all();
        return view('settings.editBook', compact('book', 'categories', 'authors'));
    }

    /**
     * Dispara la logica de edicion de un libro y retorna un redirect al listado de libros
     */
    public function editedBook($book_id, Request $request)
    {
        $book = Book::findOrFail($book_id);
        $this->bookValidator($request->all())->validate();
        $book->editWithInput($request->all());

        return redirect()->route('bookList')->with('success', 'Libro editado correctamente, recuerde que esta edicion afecta a todos sus ejemplares.');

    }

    /**
     * Borra el libro y devuelve vista
     */
    public function deleteBook($book_id)
    {
        
        $book = Book::with('onShelves.loans')->findOrFail($book_id);

        if($book->hasActiveLoans()) return back()->withErrors(['No se puede eliminar el libro ya que alguno de sus ejemplares está en calidad de prestamo.']);

        $book->delete();

        return back()->with('success', 'Libro y sus Ejemplares eliminados correctamente');

    }

    /**
     * devuelve vista de libros con enfoque en editar sus ejemplares
     */
    public function onShelveList()
    {
        $books = Book::with('author')->withCount('onShelves')->get();

        return view('settings.onShelveList', compact('books'));
    }

    /**
     * devuelve lista de ejemplares de un libro
     */
    public function onShelvesDetails($book_id)
    {
        $book = Book::with('author', 'onShelves.loans' , 'onShelves.shelve')->findOrFail($book_id);
        $shelves = Shelve::all();
        $book->addLoansStatus();

        return view('settings.onShelveDetails', compact('book', 'shelves'));
    }

    /**
     * crea nuevo ejemplar de un libro y devuelve vista
     */
    public function createOnShelve($book_id, Request $request)
    {
        $shelve = Shelve::findOrFail($request->estante);

        $new = BookOnShelf::create([
            'book_id' => $book_id,
            'shelve_id' => $request->estante
        ]);

        return back()->with('success', "Ejemplar creado correctamente, recuerde que su estante será el '$shelve->shelve' y el identificativo del ejemplar es '$new->id'");

    }

    /**
     * elimina ejemplar de de un libro y devuelve vista
     */
    public function deleteOnShelve($book_id, $onShelve_id)
    {
        $onShelve = BookOnShelf::where('book_id', $book_id)->findOrFail($onShelve_id);
        $onShelve->delete();

        return back()->with('success', 'Ejemplar eliminado correctamente');

    }

    /**
     * devuelve listado de usuarios para ver el historico de sus prestamos
     */
    public function loansPerUser()
    {
        $users = User::withCount('loans')->get();

        return view('settings.listUsers', compact('users'));
    }


    /**
     * devuelve listado de prestamos de un determinado usuario
     */
    public function detailLoansPerUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $loans = Loan::loanHistory($user_id)->get();
        
        return view('loans.history', compact('loans', 'user'));
        
    }

}
