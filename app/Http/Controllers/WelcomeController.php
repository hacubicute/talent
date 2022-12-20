<?php
 
namespace App\Http\Controllers;
 
use Response;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skills;
use App\Models\Languages;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
 
class WelcomeController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function user_registration(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',

        ]);


        if ($validator->fails())
        {
            return Response::json(array('error'=>true , 'errors'=>$validator->errors()->all()));
        }



        $user = User::create([
        	'name' => $request->name, 
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);
  
 
     
        $user->assignRole([$request->type]);

        if($user)
        {
            return Response::json(array('error' => false, 'message' => 'Registration Success', 'errors' => ''));
        }


        // return response()->json($withdrawal);    
        // return Response::json(array('error' => false, 'message' => 'Data Successfully Updated', 'errors' => ''));
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
    public function search_select(Request $request) 
    {

        $search_string = $request->search;

        if($search_string != "" || $search_string != null)
        {
            $skills = Skills::where('name','LIKE',"%{$request->search}%")->get();
        
            for($x=0; $x < sizeof($skills); $x++) 
            {
                $skills[$x]->text = $skills[$x]->name;
            }
            
            
            return response()->json($skills); 

        }
        else {
            return response()->json(null);
        }

      
    }
    public function search_language(Request $request) 
    {

        $search_string = $request->search;

        if($search_string != "" || $search_string != null)
        {
            $skills = Languages::where('name','LIKE',"%{$request->search}%")->get();
        
            for($x=0; $x < sizeof($skills); $x++) 
            {
                $skills[$x]->text = $skills[$x]->name;
            }
            
            
            return response()->json($skills); 

        }
        else {
            return response()->json(null);
        }

      
    }



    public function user_login(Request $request)
    {
        $user = User::where('email', $request->email)->first(); 

        $hashed = bcrypt($request->password);



        // return response()->json($roles);
    
        if($user)
        {
            $roles = $user->roles->pluck('name');
            
            if (Hash::check($request->password , $user->password)) 
            {
                $user_data = array(
                    'email'  => $request->get('email'),
                    'password' => $request->get('password')
                   );

                if(Auth::attempt($user_data))
                {
                    if($roles[0] == "Client")
                    {
                        return response()->json([
                            'error' => false,
                            'message' => 'Login successfully',
                            'url' => '/client/dashboard',
            
                        ]);
    
                    }
    
                    if($roles[0] == "Freelance")
                    {
                        return response()->json([
                            'error' => false,
                            'message' => 'Login successfully',
                            'url' => '/freelance/dashboard',
            
                        ]);
    
                    }

                }

              
             } 
             else {
                return Response::json(array('error' => true, 'message' => 'Username or password is incorrect', 'errors' => ''));
             }

        }
        else {
              return Response::json(array('error' => true, 'message' => 'User does not exist', 'errors' => ''));
        }

    


    }
}