<?php

namespace App\Http\Controllers;

use App\Models\DeletedCheque;
use Inertia\Inertia;

class DeletedChequeController extends Controller
{

    public function index()
    {
        $cheques = DeletedCheque::all();
        return Inertia::render('Payment/Cheque/DeletedCheques',['cheques'=>$cheques]);
    }


}
