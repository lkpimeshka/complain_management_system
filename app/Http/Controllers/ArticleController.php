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
            'txtcomplaint_name' => 'required',
            'txtcomplaint_mobile_number' => 'required',
            'txtcomplaint_nic_number' => 'required',
            'txtcomplaint_mobile_number' => 'required',
            'txtcomplaint_email' => 'required',
            'location' => 'required',
            'problem_type' => 'required',
            'txtcomplaint_remarks' => 'required',
            'FileDocumentAttachment' => 'required'
        ]);

        $data = Article::create([
            'txtcomplaint_name' => $request['txtcomplaint_name'],
            'txtcomplaint_mobile_number' => $request['txtcomplaint_mobile_number'],
            'txtcomplaint_nic_number' => $request['txtcomplaint_nic_number'],
            'txtcomplaint_mobile_number' => $request['txtcomplaint_mobile_number'],
            'txtcomplaint_email' => $request['txtcomplaint_email'],
            'location' => $request['location'],
            'problem_type' => $request['problem_type'],
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
            'txtcomplaint_name' => 'required',
            'txtcomplaint_mobile_number' => 'required',
            'txtcomplaint_nic_number' => 'required',
            'txtcomplaint_mobile_number' => 'required',
            'txtcomplaint_email' => 'required',
            'location' => 'required',
            'problem_type' => 'required',
            'txtcomplaint_remarks' => 'required',
            'FileDocumentAttachment' => 'required'
        ]);

        Article::where('id', $request['id'])
                ->update([
                    'txtcomplaint_name' => $request['txtcomplaint_name'],
                    'txtcomplaint_mobile_number' => $request['txtcomplaint_mobile_number'],
                    'txtcomplaint_nic_number' => $request['txtcomplaint_nic_number'],
                    'txtcomplaint_mobile_number' => $request['txtcomplaint_mobile_number'],
                    'txtcomplaint_email' => $request['txtcomplaint_email'],
                    'location' => $request['location'],
                    'problem_type' => $request['problem_type'],
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
