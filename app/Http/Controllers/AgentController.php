<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        //backend validation
        $validated = $request->validate([
            'email'=> 'required',
            'userName'=> 'required',
            'password'=> 'required',
            'name'=> 'required',
            'telephone'=>'required',
            'NIC'=>'required',
            'BlacklistStatus'=>'required',
        ]);

        //crating new User record
        $user = new User();
        $user->userType = 'Agent';
        $user->email = $request->email;
        $user->userName = $request->userName;
        $user->password = Hash::make($request->password);

        //creating Agent record
        if($user->save()){

            $agent = new Agent();
            $agent->user_id = $user->id;
            $agent->name = $request->name;
            $agent->telephone = $request->telephone;
            $agent->NIC = $request->NIC;
            $agent->BlacklistStatus = $request->BlacklistStatus;

            $agent->save();
        }

        //redirecting to the table
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

        error_log('here');

        error_log($request);


        //backend validation
        $validated = $request->validate([
            'id' => 'required',
            'email'=> 'required',
            'userName'=> 'required',
            'password'=> 'required',
            'name'=> 'required',
            'telephone'=>'required',
            'NIC'=>'required',
            'BlacklistStatus'=>'required',
        ]);


        //updating the users table
        if ($request->has('id')){
            $user = User::find($request->input('id'));
            $user = User::where('id', $request->input('id'))
                ->update([
                    'email'=> $request->input('email'),
                    'userName' => $request->input('userName'),
                    'password' => Hash::make($request->input('password')),
                ]);
            //updating agents table
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
        Agent::where('user_id',$id)->delete();//searching record and deleting on agents table
        User::find($id)->delete();//searching the record and deleting in User table

        return redirect::route('Agent.index');
    }
}
