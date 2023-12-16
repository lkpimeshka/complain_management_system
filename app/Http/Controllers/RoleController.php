<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class RoleController extends Controller
{

    public function index()
    { 
        $roles = Role::join('institutes', 'roles.institute', 'institutes.id')
                    ->get([
                        'roles.*',
                        'institutes.name as institutes_name',
                    ]);  
        return view('roles.index',['roles' => $roles]);
    }

    public function createRole(Request $request)
    {
        $institutes = Institute::where('id', '<>', 0)->get();
        return view('roles.createRole',['role' => $this->loginUser()->role, 'institutes' => $institutes]);
    }

    public function saveRole(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $data = Article::create([
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

        return Redirect::to('/article/list')->with('success', 'Article saved Successfully.');
    }

    public function editRole($id)
    {
        $article = Article::where('id', $id)->first();
        return view('roles.editArticle',['article' => $article]);
    }

    // Update Form data in database
    public function updateArticle(Request $request)
    {

        // Form validation
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'description' => 'required'
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
        return view('roles.viewArticle', ['article'=>$article]);
    }

    public function deleteArticle($id)
    {
        Article::where('id', $id)->delete();
        return Redirect::to('/article/list')->with('success', 'Article #'.$id.' deleted Successfully.');
    }

    public function loginUser()
    {
        return User::find(Auth::id());
    }
    
}
