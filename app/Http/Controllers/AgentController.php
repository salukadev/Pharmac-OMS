<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Inertia\Inertia;
//use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $Agent = Agent::all();
//
//        return Inertia::render('Agent/AgentDetails',[
//            'agents' => $Agent,
//        ]);

        $users = User::join('agents', 'users.id', '=', 'agents.user_id')
            ->where('users.userType', '=', 'Agent')
            ->get(['users.id', 'users.email', 'users.userName', 'users.password', 'agents.name', 'agents.telephone', 'agents.NIC', 'agents.BlacklistStatus']);

        //using Query Builder
//        $users = DB::table('users')
//            ->join('agents', 'users.id', '=', 'agents.user_id')
//            ->select('users.id', 'users.email', 'users.userName', 'users.password', 'agents.name', 'agents.telephone', 'agents.NIC', 'agents.BlacklistStatus')
//            ->where('users.userType', '=', 'Agent')
//            ->get();

        return Inertia::render('Admin/Agent/AgentDetails',[
            'agents' => $users,
        ]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Admin/Agent/AddAgent');
        //return view('app');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        error_log('hello here');
//        Agent::create(
//            Request::validate([
//                'userid' => ['required'],
//                'name'=> ['required'],
//                'telephone'=>['required'],
//                'nic'=>['required'],
//                'blkList'=>['required'],
//                ])
//        );
        //
//        error_log($request);
//
//        Agent::create($request->all());

        $user = new User();
        $user->userType = 'Agent';
        $user->email = $request->email;
        $user->userName = $request->userName;
        $user->password = $request->password;


        if($user->save()){

            $agent = new Agent();
            $agent->user_id = $user->id;
            $agent->name = $request->name;
            $agent->telephone = $request->telephone;
            $agent->NIC = $request->NIC;
            $agent->BlacklistStatus = $request->BlacklistStatus;

            $agent->save();
        }




//        Agent::create([
//            'userid' => $request->userid,
//            'name'=> $request->name,
//            'telephone'=> $request->telephone,
//            'nic'=> $request->nic,
//            'blkList'=> $request->blkList,
//        ]);

//        Request::validate([
//                'userid' => ['required'],
//                'name'=> ['required'],
//                'tele'=>['required'],
//                'nic'=>['required'],
//                'blkList'=>['required'],
//        ]);

//        $agent = Agent::create(
//            Request::only('userid',  'name', 'tele', 'nic', 'blkList')
//        );

        return redirect::route('Agent.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
  //      $agent = new Agent();
//        $agent->id = $request->id;
//        $agent->user_id = $request->user_id;
//        $agent->name = $request->name;
//        $agent->telephone = $request->telephone;
//        $agent->NIC = $request->NIC;
//        $agent->BlacklistStatus = $request->BlacklistStatus;

//        $agent->id =  $_REQUEST['agent[id]'];
//        $agent->user_id =  $_REQUEST['agent[user_id]'];
//        $agent->name =  $_REQUEST['agent[name]'];
//        $agent->telephone =  $_REQUEST['agent[telephone]'];
//        $agent->NIC =  $_REQUEST['agent[NIC]'];
//        $agent->BlacklistStatus =  $_REQUEST['agent[BlacklistStatus]'];



        return Inertia::render('Admin/Agent/AgentEdit',['agent'=> $request]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        $agent = Agent::find($request->id);
//        $agent->name= $_POST['name'];
//        $agent->telephone=$request->telephone;
//        $agent->NIC=$request->NIC;
//        $agent->BlacklistStatus=$request->BlacklistStatus;
//        $agent->save();

//        $agent = Agent::find($request->id()->update([
//            'name'=>$request->name,
//            'telephone'=>$request->telephone,
//            'NIC'=>$request->NIC,
//            'BlacklistStatus'=> $request->BlacklistStatus,
//        ]));
        error_log('here');

        error_log($request);
//        if ($request->has('id')){
//            Agent::find($request->input('id'))->update($request->all());
//            return redirect::route('Agent.index');
//        }

        //updating the users table
        if ($request->has('id')){
            $user = User::find($request->input('id'));
            $user = User::where('id', $request->input('id'))
                ->update([
                    'email'=> $request->input('email'),
                    'userName' => $request->input('userName'),
                    'password' => $request->input('password'),
                ]);

            $agent = Agent::where('user_id', $request->input('id'))
                    ->update([
                        'user_id'=> $request->input('id'),
                            'name'=> $request->input('name'),
                            'telephone'=> $request->input('telephone'),
                            'NIC'=> $request->input('NIC'),
                            'BlacklistStatus'=> $request->input('BlacklistStatus'),
                    ]);

            return redirect::route('Agent.index');
        }





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        error_log($id);
        Agent::where('user_id',$id)->delete();
        User::find($id)->delete();

        return redirect::route('Agent.index');
    }
}
