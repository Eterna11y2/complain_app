<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\complains;
use App\Models\categories;
use App\Models\subcategories;
use App\Models\StaffMapping;
use App\Models\ComplainFile;
use App\Models\states;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;




class admin_controller extends Controller
{   

    public function create_staff(Request $request)
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
        $customers->type = 2;
        $customers->save();

        return redirect('/admin/staff')->withSuccess(new HtmlString('Staff registered successfully.'));
        // if (Hash::check('my_password', $hash))
        
    }

    public function admin_dashboard()
    {
        $user = Auth::user(); 
        if($user->type == 2){
        $complains = complains::where('staff_id', $user->id)
        ->with('category')->with('subcategory')->with('state')->orderbyDESC('created_at')->take(5)->get();
        }
        else if($user->type == 1){
            $complains = complains::with('category')->with('subcategory')->with('state')->orderbyDESC('created_at')->take(5)->get();    
        }
        $categories = categories::all();
        return view('admin_dashboard',['complains' => $complains,
        'categories'=> $categories]);
    }

    public static function get_complains_count($status) 
    {   
        $user = Auth::user(); // Get the authenticated user
        $id = $user->id; // Get the user's name
        if($user->type == 1){
            if($status != 3){
                $count = complains::where('status', $status)
                ->count();
                return $count;  
            }
            else{
                $count = complains::all()
                    ->count();
                return $count;
            }
        }
        else if($user->type == 2){
        if ($status != 3)
        {
            $count = complains::where('status', $status)
                    ->where('staff_id',$id)
                    ->count();
            return $count;
        }
        else
        {
            $count = complains::where('staff_id',$id)
                    ->count();
            return $count;
        }
        }
    }

    public function admin_complains()

    {   
        $user = Auth::user();
        if($user->type != 1)
        {$complains = complains::where('staff_id',$user->id)->get();}
        else{
            $complains = complains::all();
        }        
        $categories = categories::all();
        return view('admin_complainslist',['complains' => $complains,
        'categories'=> $categories]);
    }


    public function user_management()
    {
        $users = User::orderBy('id')->where("type","!=",1)->get();
        return view('user_management',['users' => $users]);
    }
    
    public function edit_user($id)
    {   
        $user = User::findOrFail($id); 
        return view('edit_user',['user' => $user]);
    }


    public function delete_user($id)
    {
        $user = User::findOrFail($id); 
        $user->delete();
        $users = User::orderBy('id')->get();
        return redirect('/admin/user_management');
    }

    public function post_edit_user(Request $request)
    {
        $request -> validate([
            'id' => 'required',
            'name' => 'required',
            'confirm-password' => 'same:password'
        ]);

        $user = User::findOrFail($request['id']);
        $user->name = $request->name;
        if($request['password'] != ""){
        $user->password = HASH::make($request['id']);
        }
        $user->save();
        return redirect('/admin/edit_user/'.$user->id)->withSuccess(new HtmlString('<p>User Update Successfully</p>'));
    }

    public function add_category(Request $request)
    {   $request -> validate([
        'name' => 'required|unique:categories',
        ]);
        $category = new categories;
        $category->name = $request['name'];
        $category->save();
        return redirect('/admin/category')->withSuccess(new HtmlString('<p><b>'. $request['category-name'].'</b> added sucessfully </p>'));;
    }

    public function add_subcategory(Request $request)
    {   

        $request -> validate([
        'name' => 'required|unique:subcategories',
        'category-select' => 'required',
        ]);
        $selectedValue = $request->input('category-select');
        $main_category = categories::find($selectedValue);
        $category = new subcategories;
        $category->name = $request['name'];
        $category->category_id = $selectedValue;
        $category->save();
        return redirect('/admin/sub_category')->withSuccess(new HtmlString('<p><b>'.$request['category-name'].'</b> added into <b>'.$main_category->name.'</b> category sucessfully </p>'));;
    
    }
    public function category_view()

    {   $categories = categories::orderBy('id')->get();
        return view('category',['categories' => $categories]);
    }
    public function sub_category_view()
    {   
        $categories = categories::orderBy('id')->get();
        $subcategories = subcategories::with('category')->orderByDesc('id')->get();

        return view('subcategory',['categories' => $categories,'subcategories' => $subcategories]);
    }
    public function category_delete($id)
    {
        subcategories::where('category_id', $id)->delete();
        $category = categories::findOrFail($id);
        $category->delete();
        return redirect('/admin/category')->withSuccess(new HtmlString('<p> Deleted sucessfully </p>'));
    }
    public function get_category($id)
    {
        $category = categories::findOrFail($id);
        return response()->json($category);
    }

    public function sub_category_id($id)
    {
        $sub_category =subcategories::where('category_id', $id)->get();
        $idx = 1;
        foreach($sub_category as $category)
        {
            echo '<tr>    
            <td>'.$idx++.'</td>
            <td>'.$category->name.'
                <br>
                <small>
                <span class="badge badge-primary">'.$category->category->name.'</span>
                </small>
            </td>
            <td>
            <!-- Add edit and delete buttons with appropriate links -->
            <!-- <a href="'.url("/categories/".$category->id."/edit").'">Edit</a> -->
            <button class="btn btn-primary editCategory" data-toggle="modal" data-target="#modal-contact" data-id="'.$category->id .'">Edit</button>
            <a href="/admin/delete_cat/'.$category->id.'" class="btn btn-danger" onclick="return confirm(`Are you sure?`)">Delete</a>                        

            </td>
        </tr>';
            
    }
    }
    public function edit_category(Request $request)
    {   
        
        $id = $request['id'];
        $name = $request['name'];
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } 

        $category = categories::findOrFail($id);
        $category->name = $name;
        if($category->save()){
        return response()->json('Success');
        }
        else{
            return response()->json('error'); 
        }
    }

    public function edit_subcategory(Request $request)
    {   
        $id = $request['id'];
        $name = $request['name'];
        $category_dropdown = $request['category-dropdown'];
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:subcategories,name,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }    
        
        $subcategory = subcategories::findOrFail($id);
        $subcategory->name = $name;
        $subcategory->category_id = $category_dropdown;
        if($subcategory->save()){
        return response()->json('Success');
        }
        else{
            return response()->json('error'); 
        }
    }

    public function edit_staff_mapping(Request $request)
    {   
        
        $id = $request['id'];
        $category_dropdown = $request['category-dropdown'];
        $mapping = StaffMapping::findorFail($id);

            $userID = $mapping->user_id;
            $catID = $request['category-dropdown'];
            $staff_mapping = StaffMapping::where('category_id', $catID)->where('user_id', $userID)->where('id',"!=", $id)->get();

            if(!$staff_mapping->isEmpty())
            { 
               return response()->json(['errors' => "Category already assigned to this user"]);
            }
            else{
                $mapping->category_id =  $catID;
                $mapping->save();
                return response()->json('Success');
        }
    }

    public function subcategory_delete($id)
    {
        $sub_category = subcategories::findOrFail($id);
        $sub_category->delete();
        return redirect('/admin/sub_category')->withSuccess(new HtmlString('<p> Deleted sucessfully </p>'));
    }
    public function get_subcategory_ajax($id)
    {   
        $subcategory = subcategories::with('category')->find($id);
        $categories = categories::all();
        $data =[
            'categories' => $categories,
            'subcategory'=> $subcategory
        ];
        return response()->json($data); 
    }
    public function staff_view()
    {   
        return view('create_staff_form') ;
    }



    public function state_view()
    {   $states = states::all();
        return view('state',['states' => $states]) ;
    }
    public function add_state(Request $request)
    {  
        $request->validate([
        'name' => 'required|unique:states,name',
        ]);

        $states = new states;
        $states->name = Str::camel($request['name']);
        $states->save();
        return redirect('/admin/state')->withSuccess(new HtmlString('<p><b>'. $request['name'].'</b> added sucessfully </p>'));;
    }
    public function delete_state($id)
    {  

        $states = states::findOrFail($id);
        $states->delete();
        return redirect('/admin/state')->withSuccess(new HtmlString('<p> Delete sucessfully </p>'));;
    }
    public function edit_state(Request $request)
    { 
        
        $id = $request['id'];
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:states,name,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }    

        $states = states::findOrFail($request['id']);
        $states->name = Str::camel($request['name']);
        if($states->save()){
        return response()->json('Success');
        }
        else{
            return response()->json('error'); 
        }
    }

    public function staff_category_view()
    {   
        $categories = categories::all();
        $user = User::where('type',2)->whereNotIn('id', function($query){
            $query->select('user_id')->from('staff_mapping');
        })->get();
        $staffmapping = StaffMapping::with('category')->with('user')->orderBy('id')->get();
        return view('staff_mapping',[
            'categories' => $categories,
            'users' => $user,
            'staffmappings' => $staffmapping
        ]) ;
    }
    public function create_mapping(Request $request)
    {  
        $request -> validate([
        'user-select' => 'required',
        'category-select' => 'required'
        ]);
        $userID = $request->input('user-select');
        $catID = $request->input('category-select');
        $staff_mapping = StaffMapping::where('category_id', $catID)->where('user_id', $userID)->get();
        if(!$staff_mapping->isEmpty())
        { 
            return redirect('/admin/staff_category')->withErrors(['Category already assigned to user']);
        }
        else{
            $mapping = new StaffMapping;
            $mapping->category_id =  $catID;
            $mapping->user_id = $userID;
            $mapping->save();
            return redirect('/admin/staff_category')->withSuccess(new HtmlString('<p> Category assigned sucessfully </p>'));
    }
}
    public function delete_mapping($id)
    {  
        $mapping = StaffMapping::find($id);
        $mapping->delete();
        return redirect('/admin/staff_category')->withSuccess(new HtmlString('<p>Deleted Sucessfully </p>'));
    }

    public function get_mapping_category($id)
    {
        $mappings =StaffMapping::where('category_id', $id)->get();
        $idx = 1;
        foreach($mappings as $mapping)
        {   echo "<tr>    
            <td>".$idx++."</td>
            <td>".$mapping->user->name."
                <br>
                <small>
                <span class='badge badge-primary'>".$mapping->category->name."</span>
                </small>
            </td>
            <td>
            <button class='btn btn-primary editCategory'  data-toggle='modal' data-target='#modal-contact' data-id='".$mapping->id."'>Edit</button>
            <a href='/admin/delete_mapping/".$mapping->id."' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Delete</a>                        
            </td>
            </tr>";
        }
    }
    public function get_complain_form()
    {   $categories = categories::all();
        $subcategories = subcategories::all();
        $states = states::all();

        return view('complain_form',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'states' => $states,
        ]);
    }
    public function get_subcat_ajax($id)
    {

        $subcategories = subcategories::where('category_id', $id)->get();
        return response()->json($subcategories);
    }
    public function create_complain(Request $request)
    {   
        $request -> validate([
            'maincategory' => 'required',
            'subcategory-select' => 'required',
            'state-select' => 'required',
            'complainTextarea' => 'required',
            // 'images' => 'nullable|max:2048|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,rtf,csv'
        ]);
        $maincategoryID = $request->input('maincategory');
        
        $complains_count = DB::select(
            "SELECT a.id, a.name, ifnull(count(b.id), 0) as `complains_count`
            FROM `users` a 
            LEFT join complains b on a.id=b.staff_id
            left join staff_mapping c on a.id = c.user_id
            where a.type = 2 && c.category_id = ".$maincategoryID."
            Group by a.id, name
            order by `complains_count` ASC"
        );
        if(!empty($complains_count)){
            foreach($complains_count as $c){

                $staff_id = $c->id;
                break;
            }
        }
        else{
            return redirect('/complain-form')->withErrors(['No Staff Member available for this category!']);
        }
        $subcategoryID = $request->input('subcategory-select');
        $stateID = $request->input('state-select');
        $complainTextarea = $request['complainTextarea'];
        $complain_obj = new complains;
        $complain_obj->category_id = $maincategoryID;
        $complain_obj->subcategory_id = $subcategoryID;
        $complain_obj->state_id = $stateID;
        $user = Auth::user(); 
        $userid = $user->id;
        $complain_obj->user_id = $userid;
        $complain_obj->details = $complainTextarea;
        $complain_obj->staff_id = $staff_id;
        $complain_obj->status = 0;
        $complain_obj->save();

        if($request->hasFile('images'))
        {     $idx = 1;
            foreach($request->file('images') as $file)
            {
                $extension = $file->getClientOriginalExtension();
                $fileName = time().'_'.Str::random(8).'.'.$extension;  
                $destinationPath = public_path().'/complain_doc/'.$complain_obj->id ;
                $file->move($destinationPath,$fileName);
                $path = 'complain_doc/'.$complain_obj->id.'/'.$fileName;
                $complainfile = new ComplainFile;
                $complainfile->complain_id = $complain_obj->id;
                $complainfile->path = $path;
                $complainfile->save();
             
            }
            
        }
        return redirect('/complain-form')->withSuccess(new HtmlString('<p>Complain Registered Successfully </p>'));
      
    }

    public function get_complain_history()
    {
        $user = Auth::user(); 
        $complains = complains::where('user_id', $user->id)
        ->with('category')->with('subcategory')->with('state')->orderbyDESC('created_at')->get();
        return view('complains_listview',['complains' => $complains]);
    }
    public function complain_delete($id)
    
    {
        $complainfile = ComplainFile::where('complain_id',$id)->delete();
        $complains = complains::find($id);
        $complains->delete();
        return redirect('/complain-history')->withSuccess(new HtmlString('<p>Complain Delete Successfully </p>'));;
    }
    public function complain_update_status($id)
    {   $user = Auth::user();
        if($user->type == 1 || $user->type == 2)
        {
            $complain = complains::find($id);
            if($complain->status == 0)
            {
                $complain->status = 1;
                $complain->save();
                return redirect('/admin/dashboard')->withSuccess(new HtmlString('<p>Complain Delete Successfully </p>'));;
            }
            if($complain->status == 1)
            {
                $complain->status = 2;
                $complain->save();
                return redirect('/admin/dashboard')->withSuccess(new HtmlString('<p>Complain Delete Successfully </p>'));;
            }
        }
        else{
            return redirect('/dashboard');
        }
    }
    public function image_preview($filename)
    {   echo$filename;
        exit();
        $path = storage_public('images/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
    public function edit_complain(Request $request)
    {   
        $complainID = $request['id'];
        $categoryID = $request['maincategory'];
        $subcategoryID = $request['subcategory-select'];
        $complain = complains::find($complainID);
        if($complain->category_id == $categoryID)
        {
            $complain->subcategory_id = $subcategoryID;
            $complain->save();
        }
        else
        {
            $complains_count = DB::select(
                "SELECT a.id, a.name, ifnull(count(b.id), 0) as `complains_count`
                FROM `users` a 
                LEFT join complains b on a.id=b.staff_id
                left join staff_mapping c on a.id = c.user_id
                where a.type = 2 && c.category_id = ".$categoryID."
                Group by a.id, name
                order by `complains_count` ASC"
            );
            if(!empty($complains_count)){
                foreach($complains_count as $c){
    
                    $staff_id = $c->id;
                    break;
                }
            }
            else{
                return response()->json(['errors' => "No Staff Member available for this category!"]);
            }
            
            $complain->category_id = $categoryID;
            $complain->subcategory_id = $subcategoryID;
            $complain->staff_id = $staff_id;
            $complain->save();
        }


        
        return response()->json('Success');
    }

    public function forget_password(Request $request)
    {   
        $request -> validate([
            'email' => 'required|email|',
        ]);

        $admin = User::where('type', 1)->first();
        $user_email = $request['email'];

        $check = User::where('email', $user_email)->where('type','3')->first();

        if(!empty($check)){

            $to =  $admin->email;
            $subject = "Requesting Password Rest";
            $message = $user_email." requesting to change password";
            $headers = 'From: sender@example.com' . "\r\n" .
            'Reply-To: sender@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            $mail_sent = mail($to, $subject, $message, $headers);

            if ($mail_sent) {
                return redirect('/password-rest')->withSuccess(new HtmlString('<p>Request Sent!! </p>'));;
            }
            else{
            return redirect('/password-rest')->withErrors(new HtmlString('<p>Error Occured Please try again.</p>'));
            }
        }
        else{
            return redirect('/password-rest')->withErrors(new HtmlString('Email Not Found!.'));
        }
    }
    
}