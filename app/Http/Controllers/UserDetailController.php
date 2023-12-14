<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Redirect;

use DataTables;

use Illuminate\Http\Request;

class UserDetailController extends Controller
{

    public function index()
    {
        return view('userDetails.index');
    }

    /**
     * Get the data for listing in yajra.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request, UserDetail $users)
    {
        $userModel = User::all();

        foreach($userModel as $x){

            $userDetails = UserDetail::where('user_id', $x->id)->first();
            $userArr[] = array(
                'id' => $x->id,
                'user_id' => $userDetails['id'],
                'name' => $x->name,
                'email' => $x->email,
                'address_line_1' => $userDetails['address_line_1'],
                'address_line_2' => $userDetails['address_line_2'],
                'city' => $userDetails['city'],
                'company' => $userDetails['company'],
                'telephone' => $userDetails['telephone'],
            );
        }

        // $data = $users->getData();

        return \DataTables::of($userArr)
            ->addColumn('Actions', function($data) {
                return '<div class="btn-group" role="group" aria-label="Action List">
                            <a href="view-user/'.$data['id'].'" class="btn btn-info btn-sm" style="width: 35px;" title ="View"><i class="fa fa-eye" style="font-size: 12px;" aria-hidden="true"></i></a>
                            <button type="button" class="btn btn-info btn-sm" style="width: 35px;" id="getEditUserData" data-id="'.$data['id'].'" title ="Edit"><i class="fa fa-pencil-alt" style="font-size: 12px;" aria-hidden="true"></i></button>
                            <button type="button" data-id="'.$data['id'].'" data-toggle="modal" data-target="#DeleteUserModal" style="width: 35px;" class="btn btn-info btn-sm" id="getDeleteId" title ="Delete"><i class="fa fa-trash" style="font-size: 12px;" aria-hidden="true"></i></button>
                        </div>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function edit($id)
    {
        $user = new User;
        $data = $user->findData($id);
        $userDetails = UserDetail::where('user_id', $data->id)->first();

        $html = '<div class="form-group">
                    <div class = "row">
                        <div class="col-sm-6">
                            <label for="ID">ID : &nbsp;&nbsp;'.$data->id.'</label>
                        </div>
                        <div class="col-sm-6">
                            <label for="Email">Email : &nbsp;&nbsp;'.$data->email.'</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class = "row">
                        <div class="col-sm-6">
                            <label for="Name">Name:</label>
                            <input type="text" class="form-control" name="name" id="editName" value="'.$data->name.'">
                        </div>
                        <div class="col-sm-6">
                            <label for="Company">Company:</label>
                            <input type="text" class="form-control" name="company" id="editCompany" value="'.$userDetails->company.'">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class = "row">
                        <div class="col-sm-6">
                            <label for="Address_Line_1">Address Line 1:</label>
                            <input type="text" class="form-control" name="addr1" id="editAddr1" value="'.$userDetails->address_line_1.'">
                        </div>
                        <div class="col-sm-6">
                            <label for="Address_Line_2">Address Line 2:</label>
                            <input type="text" class="form-control" name="addr2" id="editAddr2" value="'.$userDetails->address_line_2.'">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class = "row">
                        <div class="col-sm-6">
                            <label for="City">City:</label>
                            <input type="text" class="form-control" name="city" id="editCity" value="'.$userDetails->city.'">
                        </div>
                        <div class="col-sm-6">
                            <label for="Telephone">Telephone:</label>
                            <input type="text" class="form-control" name="telephone" id="editTelephone" value="'.$userDetails->telephone.'">
                        </div>
                    </div>
                </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'telephone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $userData = new User();
        $userData->updateData($id, $request->all());

        // $user = UserDetail::where('user_id', $id)->first();
        // $userDetails = new UserDetail();
        // $userDetails->updateData($user->id, $request->all());

        UserDetail::where('user_id', $id) ->update([
                                                'address_line_1' => $request->input('address_line_1'),
                                                'address_line_2' => $request->input('address_line_2'),
                                                'city' => $request->input('city'),
                                                'company' => $request->input('company'),
                                                'telephone' => $request->input('telephone')
                                            ]);

        return response()->json(['success'=>'User updated successfully']);
    }

    public function viewUser($id) {

        $user = User::find($id);
        $userDetails = UserDetail::where('user_id', $id)->first();

        return view('userDetails.userView',['user'=>$user, 'userDetails' => $userDetails]);
    }

    public function changeAccountStatus($id) {

        if($this->currentUser()->role == 1){

            $user = User::find($id);
            $user->status = ($user->status == 0)? 1 : 0;
            $user->save();

            $status = ($user->status == 0)? 'Deactivated' : 'Activated';
            return Redirect::to('/view-user/'.$id)->with('success', 'Success! Account '.$status.' Successfully.');
        }else{

            return Redirect::to('/view-user/'.$id)->with('danger', "Sorry! Access Denied.");
        }

    }

    public function myAccount() {

        $user = User::find(Auth::id());
        $userDetails = UserDetail::where('user_id', Auth::id())->first();

        return view('userDetails.myAccount',['user'=>$user, 'userDetails' => $userDetails]);
    }

    function cropProfile(Request $request){

        $currentUser = Auth::id();

        $path = 'images/profile_pic/';
        $file = $request->file('user_avatar');
        $new_image_name = 'UsrAvatar'.date('Ymd').uniqid().'.jpg';
        $upload = $file->move(public_path($path), $new_image_name);

        if($upload){
            UserDetail::where('user_id', $currentUser) ->update(['image' => $new_image_name]);
            return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.']);
        }else{
              return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
        }
    }

    //update user details via user view page
    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'telephone' => 'required',
        ]);

        $userData = new User();
        $userData->updateData($request->id, $request->all());

        UserDetail::where('user_id', $request->id) ->update([
                                                'address_line_1' => $request->address_line_1,
                                                'address_line_2' => $request->address_line_2,
                                                'city' => $request->city,
                                                'company' => $request->company,
                                                'telephone' => $request->telephone
                                            ]);

        return Redirect::to('/view-user/'.$request->id)->with('success', 'Account Details has been updated.');
    }

    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'telephone' => 'required',
        ]);

        $userData = new User();
        $userData->updateData($request->id, $request->all());

        UserDetail::where('user_id', $request->id) ->update([
                                                'address_line_1' => $request->address_line_1,
                                                'address_line_2' => $request->address_line_2,
                                                'city' => $request->city,
                                                'company' => $request->company,
                                                'telephone' => $request->telephone
                                            ]);

        return Redirect::to('/my-account')->with('success', 'Account Details has been updated.');
    }

    public function destroy($id)
    {

        $userData = UserDetail::where('user_id', $id)->first();
        if($userData){
            $userDetails = new UserDetail();
            $userDetails->deleteData($userData->id);
        }

        $user = new User();
        $user->deleteData($id);

        return response()->json(['success'=>'User deleted successfully']);
    }

    public function currentUser(){

        return User::find(Auth::id());
    }
}
