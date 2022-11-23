<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Redirect;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function loginpage()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registeruser()
    {
        return view('dashboard.add-new-user');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $message = array(
            'required.email'    =>  'This is required',
            'required.password' =>  'This is required',
        );
        $this->validate($request,[
            'email' =>  'required',
            'password'  =>  'required',
        ],$message);
   
        $credentials = $request->only('email', 'password');
        if ($UserData = Auth::attempt($credentials)) {
            $user = Auth::User();
            Session::put('adminsession',$user);
            return redirect()->intended('bcb-backend');
        }
  
        return Redirect::back()->with('error', 'Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("/add-new-user")->with('message', 'User saved successfully!');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function bcbDashboard()
    {
        if(Auth::check()){
            return view('dashboard.bcb-dashboard');
        }  
        return redirect("bcb-login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'user_role' => $data['user_role'],
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'status' => $data['status']
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();  
        return Redirect('/bcb-login');
    }
    public function uniqueEmail(Request $request){
        $get_email = DB::table('users')->where('email', '=', $request->input_value)->first();
        if (!empty($get_email)) {
        	return 1;        
        }else{
            return 0;
        }
    }
    public function userList(){
        $user = DB::table('users')->get();
        return view('dashboard.list-of-user')->with('userlist',$user);
    }
    public function userDelete($uid){
        DB::table('users')->where(['id' => $uid])->delete();
        return redirect('list-of-users');
    }
    public function userEdit($uid){
        $user = DB::table('users')->where('id', $uid)->first();
        return view('dashboard.edit-user-details')->with(['user_details' => $user]);
    }
    public function userUpdate(Request $request){
        $id = $request->user_id;
        $name = $request->name;
        $email = $request->email;
        $user_role = $request->user_role;
        $status = $request->status;
        $password = Hash::make($request->new_password);

        if(!empty($request->new_password)){
            $user = DB::table('users')->where('id', $id)->first();
            if(Hash::check($request->old_password, $user->password)){
                DB::table('users')
                ->where('id',$id)
                ->update(['name' => $name, 'email' => $email, 'user_role' => $user_role, 'status' => $status, 'password' => $password, 'updated_at'=> Carbon::now('Asia/Karachi')]);
                return Redirect::back()->with(['success' => 'Data updated successfully']);
                
            }else{
                return Redirect::back()->with(['errors' => 'Old password not match']);
            }
        }else{
                DB::table('users')
                ->where('id',$id)
                ->update(['name' => $name, 'email' => $email, 'user_role' => $user_role, 'status' => $status, 'updated_at'=> Carbon::now('Asia/Karachi')]);
                return Redirect::back()->with(['success' => 'Data updated successfully']);
        }
    }
}
