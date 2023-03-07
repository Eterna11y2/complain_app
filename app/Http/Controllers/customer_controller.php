<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\complains;
use App\Models\ComplainFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;

class customer_controller extends Controller
{   

    public function register_user(Request $request)
    {  
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'contact' => 'required',
            'password' => 'required',
            'confirm-password' => 'required|same:password'
        ]);
        
        $customers = new User;
        $customers->name = $request['name'];
        $customers->email = $request['email'];
        $customers->contact = $request['contact'];
        $customers->password = Hash::make($request['password']);
        $customers->type = 3;
        $customers->save();

        return redirect('/register')->withSuccess(new HtmlString('Customer registered successfully.
                    you can now <a href="/login">login</a>'));
        // if (Hash::check('my_password', $hash))
        
    }
    public function login_user(Request $request)
    {  
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication was successful
            //$user = Auth::user(); // Get the authenticated user
            //$name = $user->name; // Get the user's name
            // $email = $user->email; // Get the user's email
            $user = Auth::user(); // Get the authenticated user
            $type = $user->type;
            if ($type == 3) {
            return redirect()->intended('/dashboard');
            }
            else{
                return redirect()->intended('/admin/dashboard');
            }
        }
        else{
        
            // Authentication failed
        return redirect('/login')->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
        }
    }
   


    public static function get_complains_count($status) 
    {   
        $user = Auth::user(); // Get the authenticated user
        $id = $user->id; // Get the user's name
        if ($status == 0)
        {
            $count = complains::where('status', 0)
                    ->where('user_id',$id)
                    ->count();
            return $count;
        }
        if ($status == 1)
        {
            $count = complains::where('status', 1)
            ->where('user_id',$id)
            ->count();
            return $count;
        }
        if ($status == 2)
        {
            $count = complains::where('status', 2)
            ->where('user_id',$id)
            ->count();
            return $count;
        }
        if ($status == 3)
        {
            $count = complains::where('user_id',$id)
                    ->count();
            return $count;
        }
    }
    
    public function dashboard()
    {
        $user = Auth::user(); 
        if($user->type == 3){
        $complains = complains::where('user_id', $user->id)
        ->with('category')->with('subcategory')->with('state')->orderbyDESC('created_at')->take(5)->get();
        }
        return view('dashboard',['complains' => $complains]);
    }
    public function add_category()
    {
        $customers = customers::orderBy('id','desc')->paginate(5);
        return view('index', ['customers' => $customers]);
        // return view('index', compact('customers'));
    }
    public function updateprofile()
    {   $user = Auth::user(); 
        return view('updateprofile', ['user' => $user]);
    }
    public function post_update_profile(Request $request)
    {
       
        $request->validate([
            'Image.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);
        if($request->hasFile('Image')) {
            $file = $request->file('Image');
            $extension = $file->getClientOriginalExtension();
            $imageName = time().'.'.$extension;  
            $destinationPath = public_path().'/images/users_profile' ;
            $file->move($destinationPath,$imageName);
            $image_path = 'images/users_profile/'.$imageName;
            $user = Auth::user(); 
            $user->image_path = $image_path;
            $user->save();
        }
        if ($request->has('user-name')) {
            $user = Auth::user(); 
            $user->name = $request['user-name'];
            $user->save();
        }
        if ($request->has('user-contact')) {
            $user = Auth::user(); 
            $user->contact = $request['user-contact'];
            $user->save();
        }
        if ($request->has('user-password')) {
            $user = Auth::user(); 
            $user->password = Hash::make($request['user-password']);
            $user->save();
        }

        if ($request->has('user-address')) {
            $user = Auth::user(); 
            $user->address = $request['user-address'];
            $user->save();
        }
        $user = Auth::user();
        $role = $user->type;
        if($role == 3){

            return redirect('/update-profile')->withSuccess(new HtmlString('<p>Profile Updated Successfully </p>'));
        
        }
        else{
            return redirect('/admin/update-profile')->withSuccess(new HtmlString('<p>Profile Updated Successfully </p>'));
        }
        
        
        
    }
    
    public static function get_complain_doc($id)
    {   
        $files = ComplainFile::where('complain_id', $id)->get();
        return $files;
    }

      
 
}
