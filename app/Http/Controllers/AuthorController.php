<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function showAllAuthors($id = null)
    {
        // return response()->json(Author::all());

        if (empty($id))
        {
            $selecionado = array('id' => 0, 'name' => '', 'email' => '', 'location' => '', 'github' => '', 'twitter' => '', 'method' => 'post');
        }
        else
        {
            $selecionado = Author::find($id);
            $selecionado['method'] = 'put';
        }

        return view('authors', ['data' => Author::all(), 'selecionado' => $selecionado]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:authors',
            'location' => 'required|alpha'
        ]);

        $data = $request->all();
        $data['latest_article_published'] = date('Y-m-d H:i:s.000');

        $author = Author::create($data);

        // return response()->json($author, 201);
        return redirect('api/authors');
    }

    public function update($id, Request $request)
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());

        // return response()->json($author, 200);
        return redirect('api/authors');
    }

    public function delete($id)
    {
        Author::findOrFail($id)->delete();
        return 200;
        // return redirect('api/authors');
    }
}