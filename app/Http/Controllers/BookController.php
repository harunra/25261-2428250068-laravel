<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Theme;
use App\Models\Section;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $fillable = ['name', 'code', 'number_of_books', 'theme_id'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::with('book_theme.theme_section')->get();  //
        return response()->json($book, 200); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'name' => 'required',
                'code' => 'required',
                'number_of_books' => 'required',
                'theme_id' => 'required|exists:themes,id'
            ]
        );
        $book = Book::create($validate); //simpan data
        if($book){
            $data['Success'] = true;
            $data['Message'] = "Data Book Berhasil Disimpan";
            $data['Data'] = $book;
            return response()->json($data, 201);//201 biar berhasil (kodenya)
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book, string $id)
    {
        $cariBook = Book::find($id);
        if($cariBook) 
        {
            $validate = $request->validate(
                [
                    'name'=>'required',
                    'code' => 'required',
                    'number_of_books' => 'required',
                    'theme_id' => 'required|exists:theme,id'
                ]
            );  

            $book = Book::where('id', $id)->update($validate); //simpan data
            if($book) {
                $data['Success'] = true;
                $data['Message'] = "Data Book Berhasil Diupdate";
                $data['Data'] = $book;
                return response()->json($data, 201);
            }
        }
        else 
        {
            $data['Success'] = false;
            $data['Message'] = "Data Book Tidak Ditemukan";
            return response()->json($data, 404); //404 Not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, string $id)
    {
        $cariBook = Book::where('id',$id);
        if(count($cariBook->get())){
            $cariBook->delete();
            $response['success'] = true;
            $response['message'] = 'Book berhasil dihapus.';
            return response()->json($response, 200);
        } else {
            $response['success'] = false;
            $response['message'] = 'Book tidak ditemukan.';
            return response()->json($response, 404);
        }
    }
}
