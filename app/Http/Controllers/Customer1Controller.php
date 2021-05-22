<?php


namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class Customer1Controller
{
    public function index()
    {

        $Customer = User::join('customers', 'users.id', '=', 'customers.user_id')
            ->where('users.userType', '=', 'customer')
            ->get(['users.id', 'users.email', 'users.userName', 'users.password', 'customers.name', 'customers.telephone', 'customers.creditLimit']);


        return Inertia::render('Client/Customer/CustomerDetails',[
            'cus' => $Customer,
        ]);




    }

    public function store(Request $request)
    {
        //crating new User record
        $user = new User();
        $user->userType = 'customer';
        $user->email = $request->email;
        $user->userName = $request->userName;
        $user->password = Hash::make($request->password);

        //creating Agent record
        if($user->save()){

            $customer = new Customer();
            $customer->user_id = $user->id;
            $customer->name = $request->name;
            $customer->approvalStatus ='Confirmed';
            $customer->telephone = $request->telephone;
            $customer->creditLimit = $request->creditLimit;
            $customer->agent_id = '1';



            $customer->save();
        }

        //redirecting to the table
        return redirect::route('Customer.index');
    }

    public function destroy($id)
    {
        //
        error_log($id);
        Customer::where('user_id',$id)->delete();//searching record and deleting on agents table
        User::find($id)->delete();//searching the record and deleting in User table

        return redirect::route('Customer.index');
    }

    public function update(Request $request)
    {

        error_log('here');

        error_log($request);



        //updating the users table
        if ($request->has('id')){
          //  $user = User::find($request->input('id'));
            $user = User::where('id', $request->input('id'))
                ->update([
                    'email'=> $request->input('email'),
                    'userName' => $request->input('userName'),
                    'password' => Hash::make($request->input('password')),
                ]);
            //updating customer table
            $customer = Customer::where('user_id', $request->input('id'))
                ->update([
                    'user_id'=> $request->input('id'),
                    'name'=> $request->input('name'),
                    'telephone'=> $request->input('telephone'),
                    'creditLimit'=> $request->input('creditLimit'),
                ]);

            return redirect::route('Customer.index');
        }
    }
}
