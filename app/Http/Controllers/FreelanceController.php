<?php
 
namespace App\Http\Controllers;
 
use Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Education;
use App\Models\Languages;
use App\Models\UserLanguages;
use App\Models\Jobs;
use App\Models\JobSkills;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

 
class FreelanceController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function dashboard(Request $request)
    {

        return view('freelance.dashboard');
    }

    public function profile(Request $request)
    {
        $languages = Languages::all();

        $user_languages = UserLanguages::where('user_languages.uid' , Auth::user()->id)->with('language')->get();

        // print_r($user_languages[0]->language);exit;
    //     $users = DB::table('users')
    // ->selectRaw('count(*) as user_count, status')
    // ->where('status', '<>', 1)
    // ->groupBy('status')
    // ->get();
  
        return view('freelance.profile')->with('languages' , $languages)->with('user_languages' , $user_languages);
    }


    public function ajax($section, Request $request)
    {

        switch ($section) {

         

            case "add_education":
                $validator = \Validator::make($request->all(), [
                    'school' => ['required', 'string', 'max:255'],
                    'from' => ['required', 'string', 'max:255'],
                    'to' => ['required', 'string', 'max:5000'],
                    'degree' => ['required', 'string', 'max:255'],
                ]);
    
                if ($validator->fails())
                {
                    return Response::json(array('error'=>true , 'errors'=>$validator->errors()->all()));
                }
    
                    
                $education = Education::create([
                    'uid' => Auth::user()->id, 
                    'school' => $request->school, 
                    'course' => $request->degree,
                    'from' => $request->from, 
                    'to' => $request->to,
                    
                ]);
    
                if($education)
                {

                    return Response::json(array('error' => false, 'message' => 'Data Added', 'errors' => ''));
    
                }
            break;

            case "add_language":

                $language = UserLanguages::create([
                    'uid' => Auth::user()->id, 
                    'lid' => $request->lang,
                    'proficiency' => $request->pro,
                    
                ]);
                if($language)
                {

                    return Response::json(array('error' => false, 'message' => 'Data Added', 'errors' => ''));
    
                }
            break;

            case "load_video":

                $user = User::where('id', Auth::user()->id)->first(); 
    

                return Response::json(array('error' => false, 'message' => 'Data Added', 'video' => $user->video_path ));

            break;

            case "load_education":

                $education = Education::where('uid', Auth::user()->id)->get(); 
    

                return Response::json($education);

            break;

            case "change_picture":

                // print_r($_FILES);exit;

                if ($request->hasFile('get_file')) {

                    // print_r($_FILES);exit;

                    $image = $request->file('get_file');
                    $full_name = $image->getClientOriginalName();
                    $filename = pathinfo($full_name, PATHINFO_FILENAME);
                    $extension = pathinfo($full_name, PATHINFO_EXTENSION);
                    $ranstr = sha1(time());
                    
                    $new_name = $filename.'_'. $ranstr. '.' . $image->getClientOriginalExtension();

                    $exists = Storage::disk('local')->has('profile_picture/');

                    $filePath = 'profile_picture/' . $new_name;

                    if (!$exists) {
                        Storage::disk('public')->makeDirectory('profile_picture/');
                    }

                    $user = User::where('id', Auth::user()->id)->first(); 
                    $get_old = $user->profile_path;
                    $user->profile_path = $new_name;
                    $user->save();
                        // echo $get_old;
                        // print_r($_FILES);exit;


                    $delete_exist = Storage::disk('public')->has('profile_picture/'. $get_old);
                   
              
                    if($delete_exist)
                    {
                        Storage::disk('public')->delete('profile_picture/'.$get_old);
                    }

                    Storage::disk('public')->put($filePath, file_get_contents($image));

                }
                else {
                    $new_name = "";
                }
                return Response::json(array('error'=>false , 'message'=>'Photo Successfully Updated','errors'=> null));
            break;

            case "change_video":

                // print_r($_FILES);exit;

                if ($request->hasFile('get_file')) {
9-
                    // print_r($_FILES);exit;

                    $image = $request->file('get_file');
                    $full_name = $image->getClientOriginalName();
                    $filename = pathinfo($full_name, PATHINFO_FILENAME);
                    $extension = pathinfo($full_name, PATHINFO_EXTENSION);
                    $ranstr = sha1(time());
                    
                    $new_name = $filename.'_'. $ranstr. '.' . $image->getClientOriginalExtension();

                    $exists = Storage::disk('local')->has('user_video/');

                    $filePath = 'user_video/' . $new_name;

                    if (!$exists) {
                        Storage::disk('public')->makeDirectory('user_video/');
                    }

                    $user = User::where('id', Auth::user()->id)->first(); 
                    $get_old = $user->video_path;
                    $user->video_path = $new_name;
                    $user->save();
                        // echo $get_old;
                        // print_r($_FILES);exit;


                    $delete_exist = Storage::disk('public')->has('user_video/'. $get_old);
                   
              
                    if($delete_exist)
                    {
                        Storage::disk('public')->delete('user_video/'.$get_old);
                    }

                    Storage::disk('public')->put($filePath, file_get_contents($image));

                }
                else {
                    $new_name = "";
                }
                return Response::json(array('error'=>false , 'message'=>'Video Successfully Updated','errors'=> null));
            break;

            case 'add_job':
            $validator = \Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:255', 'unique:jobs'],
                'level' => ['required', 'string', 'max:255'],
                'job_description' => ['required', 'string', 'max:5000'],
                'rate' => ['required', 'string', 'max:255'],
                'slot' => ['required', 'string', 'max:255'],
            ]);

            if ($validator->fails())
            {
                return Response::json(array('error'=>true , 'errors'=>$validator->errors()->all()));
            }

                
            $jobs = Jobs::create([
                'title' => $request->title, 
                'level' => $request->level,
                'jd' => $request->job_description, 
                'rate' => $request->rate,
                'slot' => $request->slot, 
                'status' => "active",
                
            ]);

            if($jobs)
            {

                $arr_skills = json_decode($request->skills , true);

                for($x=0; $x < sizeof($arr_skills); $x++) 
                {
      
                    JobSkills::create([
                        's_id' => $arr_skills[$x], 
                        'j_id' => $jobs->id, 
                    ]);

                }
                return Response::json(array('error' => false, 'message' => 'Data Added', 'errors' => ''));

            }


                
            break;
           
            default:
                # code...
            break;
        }
    }

}