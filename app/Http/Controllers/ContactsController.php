<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\User;
use App\Models\Message;
use Inertia\Inertia;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function get(){
        $contacts = User::all();
        return response()->json($contacts);

    }

    public function getMessagesFor($id)
    {

        $messages = Message::where('from', $id)->orWhere('to', $id)->get();
        return response()->json($messages);
    }

    public function send(Request $request)
    {

        $message = Message::create([

            //Auth id
            'from' => 2,
            'to' => $request->contact_id,
            'text' => $request->text

        ]);

        //broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
