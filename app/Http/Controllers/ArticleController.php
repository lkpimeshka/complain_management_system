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
            'txtcomplainer_id' => 'required',
            'location' => 'required',
            'problem_type' => 'required',
            'division_id' => 'required',
            'txtcomplaint_remarks' => 'required',
            'FileDocumentAttachment' => 'required'
        ]);

        $data = Article::create([
            'txtcomplainer_id' => $request['txtcomplainer_id'],
            'location' => $request['location'],
            'problem_type' => $request['problem_type'],
            'division_id' => $request['division_id'],
            'txtcomplaint_remarks' => $request['txtcomplaint_remarks'],
            'FileDocumentAttachment' => $request['FileDocumentAttachment'],

        ]);

        return Redirect::to('/article/list')->with('success', 'Camplaint saved Successfully.');
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
            'txtcomplainer_id' => 'required',
            'location' => 'required',
            'problem_type' => 'required',
            'division_id' => 'required',
            'txtcomplaint_remarks' => 'required',
            'FileDocumentAttachment' => 'required'
        ]);
       
        Article::where('id', $request['id'])
                ->update([
                    'txtcomplainer_id' => $request['txtcomplainer_id'],
                    'location' => $request['location'],
                    'problem_type' => $request['problem_type'],
                    'division_id' => $request['division_id'],
                    'txtcomplaint_remarks' => $request['txtcomplaint_remarks'],
                    'FileDocumentAttachment' => $request['FileDocumentAttachment']
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
