<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Redirect;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::get();
        return view('articles.index',['articles' => $articles]);
    }

    public function createArticle(Request $request)
    {
        return view('articles.createArticle');
    }

    // Store Form data in database
    public function saveArticle(Request $request)
    {

        // Form validation
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = Article::create([
            'title' => $request['title'],
            // 'description' => $request['description'],
        ]);

        return Redirect::to('/article/list')->with('success', 'Article saved Successfully.');
    }

    public function editArticle($id)
    {
        $article = Article::where('id', $id)->first();
        return view('articles.editArticle',['article' => $article]);
    }

    // Update Form data in database
    public function updateArticle(Request $request)
    {

        // Form validation
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            // 'description' => 'required'
        ]);

        Article::where('id', $request['id'])
                ->update([
                    'title' => $request['title'],
                    'description' => $request['description']
                ]);

        return Redirect::to('/article/list')->with('success', 'Article #'.$request['id'].' updated Successfully.');

    }

    public function viewArticle($id)
    {
        $article = Article::where('id', $id)->first();
        return view('articles.viewArticle', ['article'=>$article]);
    }

    public function deleteArticle($id)
    {
        Article::where('id', $id)->delete();
        return Redirect::to('/article/list')->with('success', 'Article #'.$id.' deleted Successfully.');
    }

}
