<?php
 
namespace App\Http\Controllers;
 
use Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jobs;
use App\Models\JobSkills;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

 
class ClientController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function dashboard(Request $request)
    {

        return view('client.dashboard');
    }

    public function manage_jobs(Request $request)
    {

        return view('client.manage_jobs');
    }


    public function ajax($section, Request $request)
    {
        switch ($section) {
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