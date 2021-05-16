<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::all();
        $user = auth()->user();
        $search = $request->get('search');
        if($search == null) {
            $books = Book::query()
                ->whereNull('books.user_id')
                ->withCount(['similarBooks' => function (Builder $similarBooks) {
                    return $similarBooks->whereNull('user_id');
                }])
                ->groupBy('name_id')
                ->get();

        }else{
            $books = Book::query()
                ->whereNull('books.user_id')
                ->where('books.name', 'like', '%'.$search.'%')
                ->withCount(['similarBooks' => function (Builder $similarBooks) {
                    return $similarBooks->whereNull('user_id');
                }])
                ->groupBy('name_id')
                ->get();
        }

        return view('books.index', compact(['books','genres', 'user']));
    }

//    public function search(Request $request){
//        $genres = Genre::all();
//        $user = auth()->user();
//        $search = $request->get('search');
//        $books = Book::query()
//            ->whereNull('books.user_id')
//            ->where('books.name', 'like', '%'.$search.'%')
//            ->withCount(['similarBooks' => function (Builder $similarBooks) {
//                return $similarBooks->whereNull('user_id');
//            }])
//            ->groupBy('name_id')
//            ->get();
//        //dd($books);
//        return view('books.index', compact(['books','genres', 'user']));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();

        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'nullable|file|mimes:jpg,png,jpeg'
        ]);

        $biggestNameId = Book::query()->max('name_id');

        for ($i = 1; $i <= $request->input('count'); $i++){

            $book = new Book();
            $book->name_id = $biggestNameId + 1;
            $book->name = $request->input('book_name');
            $book->author = $request->input('author');
            $book->genre_id = $request->input('genre');
            $book->year = $request->input('year');
            $book->description = $request->input('description');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();

                $filenameData = pathinfo($imageName);

                $randomName = $filenameData['filename'].'-'.now()->timestamp.'.'.$filenameData['extension'];

                File::put(public_path('uploads/books/'.$randomName), $image->getContent());

                $book->image_name = $randomName;
            }

            $book->save();
        }
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
