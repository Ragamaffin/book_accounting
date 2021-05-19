<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BooksController extends Controller
{
    public function index(Request $request)
    {
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

        return view('books.index', compact(['books', 'user']));
    }


    public function create()
    {
        if(auth()->user()->role_id < 3){
            return redirect(route('books.index'));
        }
        return view('books.create');
    }


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


    public function show(Book $book)
    {
        //
    }


    public function edit(Book $book)
    {
        if(auth()->user()->role_id < 3){
            return redirect(route('books.index'));
        }
        return view('books.edit', compact('book'));
    }


    public function update(Request $request, Book $book)
    {
        foreach ($book->similarBooks as $b){
            $b->name = $request->input('book_name');
            $b->author = $request->input('author');
            $b->year = $request->input('year');
            $b->description = $request->input('description');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();

                $filenameData = pathinfo($imageName);

                $randomName = $filenameData['filename'].'-'.now()->timestamp.'.'.$filenameData['extension'];

                File::put(public_path('uploads/books/'.$randomName), $image->getContent());

                $b->image_name = $randomName;
            }
            $b->save();
        }

        return redirect()->route('books.index');
    }


    public function destroy(Book $book)
    {
        //
    }


    public function showAddCount(Book $book)
    {
        return view('books.addCount', compact('book'));
    }


    public function addCount(Request $request, Book $book)
    {
        for($i = 1; $i <= $request->input('count'); $i++){
            $newBook = new Book();
            $newBook->name = $book->name;
            $newBook->name_id = $book->name_id;
            $newBook->author = $book->author;
            $newBook->year = $book->year;
            $newBook->description = $book->description;
            $newBook->image_name = $book->image_name;
            $newBook->save();
        }

        return redirect()->route('books.index');
    }
}
