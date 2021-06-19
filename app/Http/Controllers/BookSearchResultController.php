<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class BookSearchResultController extends Controller
{
    public function index()
    {        
        // echo $key_word;
        $request = request();
        $key_word = $request->{'key_word'};
        $search_result = Models\GoogleBooksSearch::Search($key_word);
        $data = [
            'key_word'=>$key_word,
            'search_result'=>$search_result,
        ];
        return view('Search.SearchResult',$data);
    }
}

